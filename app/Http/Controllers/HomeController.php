<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        switch (Auth::user()->profiles_id) {
            case 1:
                return view('user.home');
                break;

            case 2:
                return view('supplier.home');
                break;

            case 3:
                return view('admin.home');
                break;
        }
    }
}
