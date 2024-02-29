<?php

namespace App\Http\Controllers\Front;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CatalogueController extends Controller
{
    public function index()
    {
        //get vehicle data from database that status is 1
        $vehicles = Vehicle::with(['transactions.rating', 'transactions.user'])->where('status', 0)->get();
        // dd($vehicles);
        // $vehicleRating = Vehicle::with(['transactions.rating', 'transactions.user'])->whereRelation('transactions', 'vehicle_id', '=', $vehicles->id);
        // $vehicles = Vehicle::all();

        // $vehicles = DB::table('vehicles')->simplePaginate(8);

        // return view('user.index', ['users' => $users]);

        return view('customer.catalogue', compact('vehicles'));
    }
}
