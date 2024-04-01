<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
     {
        return view('backend/dashboard');
    }

  }
