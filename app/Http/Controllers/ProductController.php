<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $brands =Brand::where('deleted','0')->get();
        $categories =Category::where('deleted','0')->get();
        $products = Product::where('deleted','0')->get();
        
        return view('products.index',compact('products','brands','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('product_crud');

        $p = Product::where('deleted', 0)->where('barcode', $request->barcode)->first();
        if($p) return redirect()->back()->with('error', 'Barcode already exists.');

        $products  = new Product;
        $products->name = $request->name;
        $products->description = $request->description;
        $products->barcode = $request->barcode;
        $products->purchase_price = $request->purchase_price;
        $products->price = $request->price;
        $products->stock =$request->stock;
        $products->size =$request->size;
        $products->color =$request->color;
        $products->status =$request->status;
        $products->brand_id =$request->brand_id;
        $products->category_id =$request->category_id;
        $products->save();
        
        if (!$products) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, you product have been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
        return view('products.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       
        $this->authorize('product_crud');

        $product->name =$request->name;
        $product->description = $request->description;
        $product->barcode = $request->barcode;
        $product->purchase_price = $request->purchase_price;
        $product->price = $request->price;
        $product->stock =$request->stock;
        $product->size =$request->size;
        $product->color =$request->color;
        $product->status =$request->status;
        $product->brand_id =$request->brand_id;
        $product->category_id =$request->category_id;
        $product->save();
        if (!$product->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, your product have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('product_crud');

        $product->deleted =1;
        $product->update();
        return redirect()->back()->with('success','Customer delete successfully');
    }
}
