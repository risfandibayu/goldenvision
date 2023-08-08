<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function products(){
        $page_title = 'Products';
        $empty_message = 'No Products found';
        $products = Product::where('is_custom','!=',1)->paginate(getPaginate());
        return view('admin.product.index', compact('page_title','products', 'empty_message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function productsStore(Request $request){
        $prod = new Product();
        $prod->name             = $request->name;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$prod->name)) . '.jpg';
            $location = 'assets/images/product/' . $filename;
            $prod->image = $filename;

            $path = './assets/images/product/';

            $link = $path . $prod->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }

        // dd($request->file('images'));
        $prod->price            = $request->price;
        $prod->weight           = $request->weight;
        $prod->stok             = $request->stok;
        $prod->status           = $request->status?1:0;
        $prod->is_reseller      = $request->reseller?1:0;
        $prod->save();

        $notify[] = ['success', 'New Plan created successfully'];
        return back()->withNotify($notify);
    }
    public function productsUpdate(Request $request){
        $prod                  = Product::find($request->id);
        $prod->name             = $request->name;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$prod->name)) . '.jpg';
            $location = 'assets/images/product/' . $filename;
            $prod->image = $filename;

            $path = './assets/images/product/';

            $link = $path . $prod->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }

        // dd($request->file('images'));
        $prod->price            = $request->price;
        $prod->weight           = $request->weight;
        $prod->stok           = $request->stok;
        $prod->status           = $request->status?1:0;
        $prod->is_reseller         = $request->reseller?1:0;
        $prod->save();

        $notify[] = ['success', 'Product edited successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
