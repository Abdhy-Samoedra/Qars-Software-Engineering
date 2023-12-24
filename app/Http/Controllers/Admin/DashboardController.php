<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;

        // return dd($name);
        return view('admin.dashboard', compact('name'));
    }
}
