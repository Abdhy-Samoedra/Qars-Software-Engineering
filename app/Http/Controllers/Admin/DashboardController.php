<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;
        $query = DB::select('select id, name, slug from users where driving_license_status = "Unverified" AND driving_license_path IS NOT NULL AND role = "Customer"');
        $totalVehicle = DB::select('select COUNT(id) as total from vehicles');
        $totalDriver = DB::select('select COUNT(id) as total from drivers');
        $totalUser = DB::select('select COUNT(name) as total from users');
        $totalTransaction = DB::select('select COUNT(id) as total from transactions');

        // return dd($name);
        return view('admin.dashboard', compact('name', 'query', 'totalVehicle', 'totalDriver', 'totalUser', 'totalTransaction'));
    }

}
