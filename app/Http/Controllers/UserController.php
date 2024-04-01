<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register()
    {
    	return view('frontend/register');
    }

    public function login()
    {
    	return view('frontend/login');
    }

    public function forgotPassword()
    {
    	return view('frontend/forgot_password');
    }







    
}
