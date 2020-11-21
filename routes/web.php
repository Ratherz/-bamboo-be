<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
Artisan::call("storage:link");



Route::get('change/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return Redirect::back();
});

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get("setting", 'AuthController@setting');
    Route::post("setting", 'AuthController@profileUpdate');

    Route::group([ 'middleware' => ['checkRegister']], function () {
        Route::get('/', 'AdminController@index');
        Route::get('/generator', 'ProcessController@getGenerator');
        Route::post('/generator', 'ProcessController@postGenerator');
        Route::resource('roles', 'RolesController');
        // Route::resource('role-user', 'RoleUserController');
        Route::resource('users', 'UserController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('activity', 'ActivityController');
    });

    // Route::group(['prefix' => 'BPS', 'middleware' => ['checkRole:2']], function () {
    //     Route::get('/', function () {
    //         return 'ผู้ปลูกไผ่(ขายหน่อ)';
    //     });
    // });
});
Auth::routes();

Route::resource('products', 'Admin\ProductsController');
