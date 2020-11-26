<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageUpload;

use App\Models\Product;
use App\Models\ProductImg;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $products = Product::where('name', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('unit', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->orWhere('file_image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }
        $productImg = Product::join('product_img','product_img.product','=','products.id')->get()->toArray();
        // dd($productImg);
        return view('admin.products.index', ['products'=>$products,'productImg'=>$productImg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:100|required',
            'price' => 'required',
            'unit' => 'max:255|required'
        ]);
        $requestData = $request->all();
        $requestData['user_id'] = Auth::user()->id;
           
        if ($request->hasFile('file_image')) {
            $destinationPath = public_path("/storage" . '/' . Auth::user()->id);
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $files = $request->file('file_image');
            $j =0;
            
            foreach ($files as $file) {
                $input['imagename'][$j] = Auth::user()->id . '/' . time()  . '.' . $file->extension();
                ($file->move($destinationPath, time() . '.' . $file->extension()));
               
                sleep(1);
                
                $j++;
            }
               
        }
       
        Product::create($requestData);
        
    $i = 0;
    while($i!=count($files)){
        $name =  Product::select('id')
        ->orderBy('id', 'desc')
        ->limit(1)
        ->get();
        $path = $input['imagename'][$i];
        $ProductImg = new ProductImg;
        $ProductImg->path = $path;
        $str = $name[0]->getOriginal();
        $s =intval(strval(implode($str)));
        $ProductImg->product =$s ;
        $ProductImg->save();
        sleep(1);
        $i++;
    }
        
        return redirect('products')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $productImg = Product::join('product_img','product_img.product','=','products.id')->where('products.id',$id)->get()->toArray();
        // dd($product);

        return view('admin.products.show', ['product'=>$product,'productImg'=>$productImg]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'max:100|required',
            'price' => 'required',
            'unit' => 'max:255|required'
        ]);
        $requestData = $request->all();
        if ($request->hasFile('file_image')) {
            $requestData['file_image'] = ImageUpload::uploadImage($request, 'file_image');
        }
        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect('products')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('products')->with('flash_message', 'Product deleted!');
    }
}