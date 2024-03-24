<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CetakanResource;
use Illuminate\Http\Request;

use App\Models\Cetakan;
use App\Http\Resources\JalurResource;

class CetakanController extends Controller
{
    //
    public function index(Request $request)
    {
    	$data = Cetakan::get();

    	return CetakanResource::collection($data);
    }
}
