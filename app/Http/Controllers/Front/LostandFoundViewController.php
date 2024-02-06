<?php

namespace App\Http\Controllers\Front;
use App\Models\Vehicle;
use App\Models\LostAndFound;
use App\Http\Controllers\Controller;

class LostandFoundViewController extends Controller
{
    public function index(){

        $data = LostAndFound::with(['vehicles'])->get();
        



        return view('customer.lostandfound', compact(['data']));
    }
}