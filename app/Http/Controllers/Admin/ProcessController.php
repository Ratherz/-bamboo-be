<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProcessController extends Controller
{
    /** @var string  */
    protected $routeName = '';

    /** @var string  */
    protected $controller = '';
    /**
     * Display generator.
     *
     * @return Response
     */
    public function getGenerator()
    {
        return view('laravel-admin.generator');
    }
    
    public function postGenerator(Request $request)
    {
        $commandArg = [];
        $commandArg['name'] = $request->crud_name;

        $dbColumns = DB::select("show columns from `$request->selected_table`");
        $fKeys = DB::select("select * from information_schema.referential_constraints where TABLE_NAME = '$request->selected_table';");
        $x = 0;

        if (!empty($dbColumns)) :
            $fieldsArray = [];
            $validationsArray = [];
            $uniqueFields = [];
            $fkFields = [];
            $relationFields = [];
            foreach ($dbColumns as $column) :
                $unsigned = strpos($column->Type, 'unsigned') ? "#unsigned" : "";
                $type = '';
                //fields
                if (substr($column->Field, 0, 4) == 'file') {
                    $type = 'file';
                } else if (substr($column->Type, 0, 6) == 'bigint') {
                    $type = "bigint";
                } else if (substr($column->Type, 0, 3) == 'int') {
                    $type = 'integer';
                } else if (substr($column->Type, 0, 7) == 'varchar') {
                    $type = 'varchar';
                } else if (substr($column->Type, 0, 7) == 'decimal') {
                    $type = 'float';
                } else if (substr($column->Type, 0, 8) == 'tinytext') {
                    $type = 'text';
                } else if (substr($column->Type, 0, 7) == 'tinyint') {
                    $type = 'integer';
                } else {
                    $type = $column->Type;
                }

                //primary key
                if ($column->Key == "PRI") {
                    $commandArg['--pk'] = $column->Field;
                } else if ($column->Key == "UNI") {
                    // title,field1|field2#unique
                    array_push($uniqueFields, "$column->Field,$column->Field#unique");
                } else if ($column->Key == "MUL") {
                    //foreing key "user_id#id#users#cascade"

                    //`--relationships="comments#hasMany#App\Comment"`

                    $primaryK = DB::select("show columns from `{$fKeys[$x]->REFERENCED_TABLE_NAME}`")[0]->Field;
                    $updateType = strtolower($fKeys[$x]->UPDATE_RULE);
                    array_push($fkFields, "$column->Field#$primaryK#{$fKeys[$x]->REFERENCED_TABLE_NAME}#$updateType");

                    $modelName = explode("_", $fKeys[$x]->REFERENCED_TABLE_NAME);

                    if (sizeOf($modelName) > 1) {
                        $list = [];
                        foreach ($modelName as $name) {
                            array_push($list, strtoupper(substr($name[0], 0, 1)) . substr($name[0], 1));
                        }
                        $modelName = implode("", $list);
                    } else {
                        $modelName = strtoupper(substr($modelName[0], 0, 1)) . substr($modelName[0], 1);
                    }
                    array_push($relationFields, "{$fKeys[$x]->REFERENCED_TABLE_NAME}#belongsTo#App\\$modelName");
                    $x++;
                }

                //make fields
                if ($column->Field != 'created_at' && $column->Field != 'updated_at' && $column->Field != 'id') {
                    array_push($fieldsArray, $column->Field . '#' . $type . $unsigned);
                    if ($column->Null == "NO") {
                        $size = explode("(", $column->Type);
                        if (sizeOf($size) > 1) {
                            $size = "max:" . ((int)explode(')', $size[1])[0]) . '|';
                        } else {
                            $size = '';
                        }
                        //make validation
                        array_push($validationsArray, $column->Field . "#{$size}required");
                    }
                }

            endforeach;

            $commandArg['--fields'] = implode(";", $fieldsArray);
            // dd($commandArg);
            $commandArg['--validations'] = implode(";", $validationsArray);
            if (!empty($uniqueFields)) {
                $commandArg['--indexes'] = implode(";", $uniqueFields);
            }
            if (!empty($fKeys)) {
                $commandArg['--foreign-keys'] = implode(";", $fkFields);
            }
            if (!empty($relationFields)) {
                $commandArg['--relationships'] = implode(";", $relationFields);
            }
        endif;

        if ($request->has('route')) {
            $commandArg['--route'] = $request->route;
        }

        if ($request->has('view_path')) {
            $commandArg['--view-path'] = $request->view_path;
        }

        if ($request->has('controller_namespace')) {
            $commandArg['--controller-namespace'] = $request->controller_namespace;
        }

        if ($request->has('model_namespace')) {
            $commandArg['--model-namespace'] = $request->model_namespace;
        }

        if ($request->has('route_group')) {
            $commandArg['--route-group'] = $request->route_group;
        }

        if ($request->has('form_helper')) {
            $commandArg['--form-helper'] = $request->form_helper;
        }

        if ($request->has('soft_deletes')) {
            $commandArg['--soft-deletes'] = $request->soft_deletes;
        }
        if ($request->has('localize')) {
            $commandArg['--localize'] = $request->localize;
        }
        if ($request->has('locales')) {
            $commandArg['--locales'] = $request->locales;
        }
        try {
            $name = $request->crud_name;
            $modelName = Str::singular($name);
            $migrationName = Str::plural(Str::snake($name));
            $tableName = $request->selected_table;
            $routeGroup = $commandArg['--route-group'];
            $this->routeName = ($routeGroup) ? $routeGroup . '/' . Str::snake($name, '-') : Str::snake($name, '-');
            $perPage = 25;
            $controllerNamespace = $commandArg['--controller-namespace'] ? $commandArg['--controller-namespace'] . '\\' : '';
            $modelNamespace = ($commandArg['--model-namespace']) ? trim($commandArg['--model-namespace']) . '\\' : 'Models\\';
            $fields = rtrim($commandArg['--fields'], ';');
            $primaryKey = $commandArg['--pk'];
            $viewPath = $commandArg['--view-path'];
            $foreignKeys = $commandArg['--foreign-keys'] ?? '';
            $validations = trim($commandArg['--validations']) ?? '';
            $fieldsArray = explode(';', $fields);
            $fillableArray = [];
            $migrationFields = '';
            $indexes = $commandArg['--indexes'] ?? '';
            $localize = 'yes';
            $locales = 'th';
            $relationships = $commandArg['--relationships'] ?? '';


            foreach ($fieldsArray as $item) {
                $spareParts = explode('#', trim($item));
                $fillableArray[] = $spareParts[0];
                $modifier = !empty($spareParts[2]) ? $spareParts[2] : 'nullable';

                // Process migration fields
                $migrationFields .= $spareParts[0] . '#' . $spareParts[1];
                $migrationFields .= '#' . $modifier;
                $migrationFields .= ';';
            }

            $commaSeparetedString = implode("', '", $fillableArray);
            $fillable = "['" . $commaSeparetedString . "']";
            $formHelper = $commandArg['--form-helper'];
            $softDeletes = $commandArg['--soft-deletes'];
            // dd($commandArg);
            switch ($request->choice) {
                case 'CRUD':
                    Artisan::call('crud:controller', ['name' => $controllerNamespace . $name . 'Controller', '--crud-name' => $name, '--model-name' => $modelName, '--model-namespace' => $modelNamespace, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--pagination' => $perPage, '--fields' => $fields, '--validations' => $validations]);
                    Artisan::call('crud:model', ['name' => $modelNamespace . $modelName, '--fillable' => $fillable, '--table' => $tableName, '--pk' => $primaryKey, '--relationships' => $relationships, '--soft-deletes' => $softDeletes]);
                    // Artisan::call('crud:migration', ['name' => $migrationName, '--schema' => $migrationFields, '--pk' => $primaryKey, '--indexes' => $indexes, '--foreign-keys' => $foreignKeys, '--soft-deletes' => $softDeletes]);
                    Artisan::call('crud:lang', ['name' => $name, '--fields' => $fields, '--locales' => 'th']);
                    Artisan::call('crud:lang', ['name' => $name, '--fields' => $fields, '--locales' => 'en']);
                    Artisan::call('crud:view', ['name' => $name, '--fields' => $fields, '--validations' => $validations, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--localize' => $localize, '--pk' => $primaryKey, '--form-helper' => $formHelper]);
                    $comments = DB::select("SHOW FULL COLUMNS FROM `$tableName`");
                    $lang = "<?php\r\n \r\n return[\r\n";
                    foreach ($comments as $comment) {
                        $comment->Comment = empty($comment->Comment) ? $comment->Field : $comment->Comment;
                        $lang .= "'$comment->Field'=>'{$comment->Comment}',\n";
                        // $arr[$comment->Field] = $comment->Comment;
                    }
                    $lang .= "];\r\n";
                    File::put(base_path("resources/lang/th/$name.php"), $lang);
                    break;
                case 'Controller':
                    Artisan::call('crud:controller', ['name' => $controllerNamespace . $name . 'Controller', '--crud-name' => $name, '--model-name' => $modelName, '--model-namespace' => $modelNamespace, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--pagination' => $perPage, '--fields' => $fields, '--validations' => $validations]);
                    break;
                case 'API Controller':
                    Artisan::call('crud:api-controller', ['name' => $controllerNamespace . $name . 'Controller', '--crud-name' => $name, '--model-name' => $modelName, '--model-namespace' => $modelNamespace, '--pagination' => $perPage, '--validations' => $validations]);
                    break;
                case 'Model':
                    Artisan::call('crud:model', ['name' => $modelNamespace . $modelName, '--fillable' => $fillable, '--table' => $tableName, '--pk' => $primaryKey, '--relationships' => $relationships, '--soft-deletes' => $softDeletes]);
                    break;
                case 'View':
                    Artisan::call('crud:view', ['name' => $name, '--fields' => $fields, '--validations' => $validations, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--localize' => $localize, '--pk' => $primaryKey, '--form-helper' => $formHelper]);
                    break;
                case 'Lang':
                    Artisan::call('crud:lang', ['name' => $name, '--fields' => $fields, '--locales' => 'en']);
                    Artisan::call('crud:lang', ['name' => $name, '--fields' => $fields, '--locales' => 'th']);
                    $comments = DB::select("SHOW FULL COLUMNS FROM `$tableName`");
                    $lang = "<?php\r\n \r\n return[\r\n";
                    foreach ($comments as $comment) {
                        $comment->Comment = empty($comment->Comment) ? $comment->Field : $comment->Comment;
                        $lang .= "'$comment->Field'=>'{$comment->Comment}',\n";
                        // $arr[$comment->Field] = $comment->Comment;
                    }
                    $lang .= "];\r\n";
                    File::put(base_path("resources/lang/th/$name.php"), $lang);
                    // dd(File::get(base_path("resources/lang/th/$name.php")));
                    // dd(File::put(base_path("resources/lang/th/$name.php"),$lang));
                    break;
                case 'Migration':
                    Artisan::call('crud:migration', ['name' => $migrationName, '--schema' => $migrationFields, '--pk' => $primaryKey, '--indexes' => $indexes, '--foreign-keys' => $foreignKeys, '--soft-deletes' => $softDeletes]);
                    break;
                case 'API CRUD':
                    Artisan::call('crud:api-controller', ['name' => $controllerNamespace . $name . 'Controller', '--crud-name' => $name, '--model-name' => $modelName, '--model-namespace' => $modelNamespace, '--pagination' => $perPage, '--validations' => $validations]);
                    Artisan::call('crud:model', ['name' => $modelNamespace . $modelName, '--fillable' => $fillable, '--table' => $tableName, '--pk' => $primaryKey, '--relationships' => $relationships, '--soft-deletes' => $softDeletes]);
                    // Artisan::call('crud:migration', ['name' => $migrationName, '--schema' => $migrationFields, '--pk' => $primaryKey, '--indexes' => $indexes, '--foreign-keys' => $foreignKeys, '--soft-deletes' => $softDeletes]);
                    break;
                default:
                    # code...
                    break;
            }
            $routeFile = base_path('routes/web.php');
            if (file_exists($routeFile) && (strtolower($commandArg['--route']) === 'yes')) {
                $this->controller = ($controllerNamespace != '') ? $controllerNamespace . $name . 'Controller' : $name . 'Controller';
                File::append($routeFile, "\n" . implode("\n", ["Route::resource('" . $this->routeName . "', '" . $this->controller . "');"]));
            }

            // $menus = json_decode(File::get(base_path('resources/laravel-admin/menus.json')));

            // $name = $commandArg['name'];
            // $routeName = ($commandArg['--route-group']) ? $commandArg['--route-group'] . '/' . Str::snake($name, '-') : Str::snake($name, '-');

            // $menus->menus = array_map(function ($menu) use ($name, $routeName) {
            //     if ($menu->section == 'Resources') {
            //         array_push($menu->items, (object) [
            //             'title' => $name,
            //             'url' => '/' . $routeName,
            //         ]);
            //     }

            //     return $menu;
            // }, $menus->menus);

            // File::put(base_path('resources/laravel-admin/menus.json'), json_encode($menus));

            // Artisan::call('migrate');
        } catch (\Exception $e) {
            return Response::make($e->getMessage(), 500);
        }

        return redirect()->back()->with('flash_message', 'CRUD = ' . $this->routeName);
    }
}
