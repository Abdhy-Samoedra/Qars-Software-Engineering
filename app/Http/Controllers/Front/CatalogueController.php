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
        $vehicles = Vehicle::where('status', 0)->get();
        // $vehicles = Vehicle::all();

        // $vehicles = DB::table('vehicles')->simplePaginate(8);
 
        // return view('user.index', ['users' => $users]);

        return view('customer.catalogue' , compact('vehicles'));
    }
}