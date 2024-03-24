<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

use App\Models\TrMaterial;
use Illuminate\Support\Facades\DB;

class SukuCadangController extends Controller
{
    public function index()
    {
    	return view('pages.sukucadang.index');
    }

    public function data()
    {
    	$data = TrMaterial::where('kd_jmaterial', 'S');

    	return DataTables::eloquent($data)
    	    ->addColumn('saldo', function ($model) {
				$stock = DB::select("select  WOS.\"FNC_GET_APK_SALDO\" (to_Date('" . date('d/m/Y') . "','dd/mm/yyyy'), '2A', '" . $model->kd_material . "')saldo from dual")[0];
    	        return $stock->saldo ?? 0;
    	    })
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
