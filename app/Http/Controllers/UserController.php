<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.user');
    }

    public function store(UserUpdateRequest $userUpdateRequest, User $user)
    {
        $user->name = $userUpdateRequest->input('name'); //$userUpdateRequest->name;
        $user->email = $userUpdateRequest->email;
        $user->password = Hash::make($userUpdateRequest->password);
        $user->profile_id = $userUpdateRequest->profile_id;
        $user->active = $userUpdateRequest->active;
        // dd($user);
        $response = $user->save();

        return json_encode($response);
    }

    public function update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        $user = User::findOrFail($userUpdateRequest->id);
        $user->name = $userUpdateRequest->name;
        $user->email = $userUpdateRequest->email;
        $user->password = Hash::make($userUpdateRequest->password);
        $user->profile_id = $userUpdateRequest->profile_id;
        $user->active = $userUpdateRequest->active;
        $response = $user->update();

        return json_encode($response);
    }

    public function all(Request $userUpdateRequest)
    {
        $users = User::all();
        return $users;
    }
}
