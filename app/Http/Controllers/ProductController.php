<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
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
            return response()->json([
                'status' => true,
                'message' => $product
            ]);
        }
        return response($status=404)->json([
            'status' => false,
            'message' => $product
        ])->setStatusCode(404);
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
        return response()->json([
            'status' => true,
            'message' => $product
        ]);
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
            return response()->json([
                'status' => true,
                'message' => $product
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => $product
        ])->setStatusCode(404);
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
            return response()->json([
                'status' => true,
                'message' => $product
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => $product
        ]);
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
        return response()->json([
            'status' => true,
            'message' => $product
        ]);
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
        return response()->json([
            'status' => true,
            'message' => $product
        ]);
    }
}
