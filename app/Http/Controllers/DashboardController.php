<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FPerbaikan;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index()
    {
    	$locations = Location::all()->pluck('ket', 'kd_lokasi')->toArray();
        $labelLocations = ["" => "-             All             -"];
        $locations = $labelLocations + $locations;

    	return view('pages.dashboard.inventory', [
    		'locations' => $locations
    	]);
    }
}
