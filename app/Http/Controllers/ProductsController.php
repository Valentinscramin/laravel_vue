<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = new Products();
        $products->name = $request->name;
        $products->price = $request->price;
        $products->weight = $request->weight;
        $products->categorie_id = $request->categorie_id;
        $products->active = $request->active;
        $response = $products->save();

        return json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        $products = Products::find($request->id);
        $products->name = $request->name;
        $products->price = $request->price;
        $products->weight = $request->weight;
        $products->categorie_id = $request->categorie_id;
        $products->active = $request->active;
        $response = $products->update();

        return json_encode($response);
    }

    public function all()
    {
        $products = Products::all();
        return $products;
    }
}
