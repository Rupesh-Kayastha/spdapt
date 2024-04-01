<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
	public function couponPage()
    {
    	return view('frontend/theme/coupons');
    }

    public function carsPage()
    {
    	return view('frontend/theme/cars');
    }

    public function ecommPage()
    {
    	return view('frontend/theme/ecommerce');
    }

    public function marketPage()
    {
    	return view('frontend/theme/marketplace');
    }

















}
