<?php

namespace App\Http\Controllers\Front;

use App\Models\Rating;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with(['vehicleCategory'])->latest()->take(4)->get()->reverse();
        $ratings = Rating::join('transactions', 'transactions.id', '=', 'ratings.transactions_id')
            ->join('vehicles',  'vehicles.id', '=', 'transactions.vehicle_id')
            ->where('transactions.vehicle_id', '=', $vehicles->first()->id)->get();
        return view('landing', compact('vehicles', 'ratings'));
    }
}