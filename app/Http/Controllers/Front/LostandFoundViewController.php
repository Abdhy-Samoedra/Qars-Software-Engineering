<?php

namespace App\Http\Controllers\Front;
use App\Models\Vehicle;
use App\Models\LostAndFound;
use App\Http\Controllers\Controller;

class LostandFoundViewController extends Controller
{
    public function index()
    {
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        $data = LostAndFound::with('vehicles')->paginate(5);
        return view('customer.lostandfound', compact('data'));
    }
}
