<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $slug)
    {
        $vehicle = Vehicle::with(['vehicleCategory'])->whereSlug($slug)->firstOrFail();
        // dd($vehicle);
        return view('customer.checkout', compact('vehicle'));
    }

    public function store(Request $request, $slug)
    {
        // return $request->all();
        // dd($request->has('checkbox'));

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        // dd($request->start_date);
        // format start date dan end date from dd mm yy to time stamp
        // dd($request->start_date, $request->end_date);
        $start_date = Carbon::createFromFormat('d m Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date);

        // count number between start and date
        $days = $start_date->diffInDays($end_date);
        // dd($start_date->diffInDays($end_date)); 

        // get item
        $vehicle = Vehicle::whereSlug($slug)->firstOrFail();

        // random driver with status available
        $driver = Driver::where('status', 'available')->inRandomOrder()->first();
        // dd($driver);

        //calculate total price
        // dd($item->price);

        $total_price = $days * $vehicle->rental_price;
        // dd($total_price);

        // add 10% taxxxx
        $total_price = $total_price + ($total_price * 0.1);

        // dd($days);
        // create the booking       

        $transactionData = [
            'user_id' => auth()->user()->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total_days' => $days,
            'total_price' => $total_price,
        ];

        if ($total_price < 1500000) {
            $transactionData['exp_reward'] = 100;
        }else if ($total_price > 1500000 && $total_price < 3000000) {
            $transactionData['exp_reward'] = 150;
        }else if ($total_price > 3000000) {
            $transactionData['exp_reward'] = 250;
        }

        if ($request->has('checkbox') === true || Auth::user()->driving_license_status === 'Unverified') {
            $transactionData['driver_id'] = $driver->id;
        }

        $transaction = $vehicle->transactions()->create($transactionData);
        $transaction->refresh();
        // dd($transaction);

        return redirect()->route('front.payment', $transaction->id);
    }
}
