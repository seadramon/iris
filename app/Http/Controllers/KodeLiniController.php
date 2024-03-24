<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\KodeLini;

class KodeLiniController extends Controller
{
    
    public function index()
    {
    	return view('pages.kodelini.index');
    }

    public function data()
    {
    	$data = KodeLini::select('kd_lini', 'ket');

    	return DataTables::eloquent($data)
    	    ->addColumn('menu', function ($model) {
    	        $edit = '<div class="btn-group">
    	            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    	            Action
    	          </button>
    	          <ul class="dropdown-menu">
    	            <li><a class="dropdown-item" href="#">View</a></li>
    	          </ul>
    	        </div>';
    	        return $edit;
    	    })
    	    ->rawColumns(['menu'])
    	    ->toJson();
    }
}
