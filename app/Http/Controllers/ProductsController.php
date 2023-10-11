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
        return json_encode($products::create($request->all()));
    }

    public function update(Request $request, Products $products)
    {
        return json_encode($products->update($request->all()));
    }

    public function all(Products $products)
    {
        return $products->with('categories')->get();
    }
}
