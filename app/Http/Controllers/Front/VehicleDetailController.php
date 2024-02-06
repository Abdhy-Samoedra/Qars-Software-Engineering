<?php

namespace App\Http\Controllers\Front;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Transaction;
use App\Models\User;

class VehicleDetailController extends Controller
{
    public function show($slug)
    {
        $vehicle = Vehicle::whereSlug($slug)->firstOrFail();
        $similiarItems = Vehicle::with(['vehicleCategory', 'transactions.rating'])
            ->where('id', '!=', $vehicle->id)
            ->where('vehicle_category_id', '=', $vehicle->vehicle_category_id)
            ->latest()->take(4)->get();
        // dd($similiarItems);

        $vehicleRating = Vehicle::with(['transactions.rating', 'transactions.user'])->whereRelation('transactions', 'vehicle_id', '=', $vehicle->id)->first();


        // dd($similiarItems);
        // ->whereRelation('transactions', 'vehicle_id', '=', 'B 3288 JDW')
        // latest()->take(4)
        //     ->get();

        // dd($vehicleRating);

        return view('customer.vehicleDetail', [
            'vehicle' => $vehicle,
            'similiarItems' => $similiarItems,
            'vehicleRating' => $vehicleRating
        ]);
    }
}
