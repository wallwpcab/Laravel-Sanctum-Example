<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        if(isset($product)) {
            return $this->sendResponse($product, 'Product list');
        }
        return $this->sendError($product, 'No Product', 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);
        $product = Product::create($request->all());
        return $this->sendResponse($product, 'New product', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        if(isset($product)) {
            return $this->sendResponse($product, 'Product with id: ' . $id, 200);
        }
        return $this->sendError($product, 'Not found product with id: '. $id, 404);
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
        $product = Product::find($id);
        if(isset($product)) {
            $product->update($request->all());
            return $this->sendResponse($product, 'Update product id: '. $id . 'Success', 200);
        }
        return $this->sendError($product, 'Update failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::destroy($id);
        return $this->sendResponse($product, 'Destroy product id: '. $id);
    }

        /**
     * Search the specified resource from storage.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $product = Product::where('name', 'like', '%'.$name.'%')->get();
        return $this->sendResponse($product, 'Found product');
    }
}
