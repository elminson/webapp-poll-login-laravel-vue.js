<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VueHomeController extends Controller
{
      /**
     * Show the application login vue.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vue');
    }
}
