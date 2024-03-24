<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jalur;
use App\Models\Pat;
use App\Http\Resources\JalurResource;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use DB;
use Exception;

class RoleController extends Controller
{
    //
    public function create(Request $request)
    {
        $data = Role::with('mobile_menus')->where('grpid', $request->roleid)->firstOrFail();
        // return response()->json($request->all());

        return new RoleResource($data);
    }
}
