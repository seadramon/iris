<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{
    
    public function index()
    {
    	return view('pages.home');
    }
}
