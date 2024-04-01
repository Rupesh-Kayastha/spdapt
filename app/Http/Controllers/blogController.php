<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class blogController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function memberblog(Request $request)
    {
        return view('frontend/member_blog');
    }


}
