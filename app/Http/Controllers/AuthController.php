<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //login page
    public function login() {
        return view('login');
    }

    // register page
    public function register() {
        return view('register');
    }

    // dashboard
    public function dashboard() {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
         }
             return redirect()->route('home#page');

    }

}
