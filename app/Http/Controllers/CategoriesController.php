<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('admin.categories');
    }

    public function store(Request $request, Categories $categories)
    {
        return json_encode($categories::create($request->all()));
    }

    public function update(Request $request, Categories $categories)
    {
        return json_encode($categories->update($request->all()));
    }

    public function all(Categories $categories)
    {
        return $categories->with('products')->get();
    }
}
