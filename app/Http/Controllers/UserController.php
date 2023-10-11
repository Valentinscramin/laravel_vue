<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.user');
    }

    public function store(Request $request, User $user)
    {
        $request['password'] = Hash::make($request->password);
        $response = $user::create($request->all());

        return json_encode($response);
    }

    public function update(Request $request, User $user)
    {
        $request['password'] = Hash::make($request->password);
        $response = $user->update($request->all());

        return json_encode($response);
    }

    public function all(User $user)
    {
        return $user->with('profiles')->get();
    }
}
