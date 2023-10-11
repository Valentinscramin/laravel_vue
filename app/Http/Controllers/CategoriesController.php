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
        $response = $categories::create($request->all());
        return json_encode($response);
    }

    public function update(Request $request, Categories $categories)
    {
        $response = $categories->update($request->all());

        return json_encode($response);
    }

    public function all(Categories $categories)
    {
        return $categories->with('products')->get();
    }
}
