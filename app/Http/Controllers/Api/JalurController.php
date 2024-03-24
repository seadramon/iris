<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jalur;
use App\Models\Pat;
use App\Http\Resources\JalurResource;

use DB;
use Exception;

class JalurController extends Controller
{
    //
    public function index(Request $request)
    {
    	$data = Jalur::with(['pat'])->get();

    	return JalurResource::collection($data);
    }
}
