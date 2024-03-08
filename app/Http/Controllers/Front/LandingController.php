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
        $vehicles = Vehicle::with(['vehicleCategory'])->where('status', 0)->latest()->take(4)->get()->reverse();
        return view('landing', compact('vehicles'));
    }
}
