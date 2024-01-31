<?php

namespace App\Http\Controllers\Front;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleDetailController extends Controller
{
    public function show($slug)
    {
        $vehicle = Vehicle::whereSlug($slug)->firstOrFail();
        $similiarItems = Vehicle::
            where('id', '!=', $vehicle->id)
            ->get();

        return view('customer.vehicleDetail', [
            'vehicle' => $vehicle,
            'similiarItems' => $similiarItems 
        ]);
    }
}
