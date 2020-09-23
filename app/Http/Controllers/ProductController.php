<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        
        // Add product image
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $product->image = $this->productImage($request->photo);
        }

        // Associate the product with the selected category
        $category = Category::find($request->input('category_id'));
        $product->category()->associate($category);

        $product->save();

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        
        // Add product image
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $product->image = $this->productImage($request->photo);
        }

        // Associate the product with the selected category
        if($request->filled('category_id') && $request->input('category_parent') != $product->category_id){
            $category = Category::find($request->input('category_id'));
            $product->category()->associate($category);
        }

        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }

    /**
     * Store a newly product image.
     *
     */
    public function productImage($image)
    {
        $product_image_name = 'product_'.time().'.'.$image->extension();
        $image->storeAs('products',$product_image_name);

        return 'products/'.$product_image_name;
    }
}
