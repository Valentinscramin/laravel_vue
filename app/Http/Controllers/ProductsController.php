<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('admin.products');
    }

    public function store(Request $request, Products $products)
    {
        $response = $products::create($request->all());

        return json_encode($response);
    }

    public function update(Request $request, Products $products)
    {
        $response = $products->update($request->all());

        return json_encode($response);
    }

    public function all(Products $products)
    {
        return $products->with('categories')->get();
    }
}
