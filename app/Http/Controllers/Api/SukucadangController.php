<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TrMaterial;
use App\Http\Resources\TrMaterialResource;

use DB;

class SukucadangController extends Controller
{
    
    public function index(Request $request)
    {
    	$perPage = !empty($request->perpage)?$request->perpage:20;

    	$data = TrMaterial::where('kd_jmaterial', 'S');

    	if (!empty($request->search)) {
    		$search = strtolower($request->search);

    		$data->where(function($query) use($search){
    			$query->where(DB::raw("LOWER(kd_material)"), 'like', '%'.$search.'%')
    				->orWhere(DB::raw("LOWER(uraian)"), 'like', '%'.$search.'%');
    		});
    	}

    	return TrMaterialResource::collection($data->paginate($perPage));
    }
}
