<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        $user_id = auth()->user()->id;

        $status = $request->get('status');

        if(!isset($status))
        {
            $status = 'Pending';
        }

        if($status == 'reserved')
        {
            $status = 'Pending';
        } else if($status == 'ongoing')
        {
            $status = 'Confirmed';
        } else if($status == 'done')
        {
            $status = 'Done';
        }

        $data = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
            ->join('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
            ->join('vehicle_categories', 'vehicle_categories.id', '=', 'vehicles.vehicle_category_id')
            ->where('transactions.user_id', '=', $user_id)
            ->where('transactions.status', '=', $status)
            ->select(
                'transactions.*',
                'users.name',
                'vehicles.car_picture',
                'vehicles.id as vehicle_id',
                'vehicles.brand as vehicle_brand',
                'vehicle_categories.vehicle_category_name as category_name')
            ->orderBy('transactions.start_date', 'desc')
            ->paginate(12);

        return view('customer.orderListPage', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        $transaction = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
            ->join('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
            ->join('vehicle_categories', 'vehicle_categories.id', '=', 'vehicles.vehicle_category_id')
            ->where('transactions.id', '=', $id)
            ->select(
                'transactions.*',
                'users.name',
                'vehicles.car_picture',
                'vehicles.id as vehicle_id',
                'vehicles.brand as vehicle_brand',
                'vehicle_categories.vehicle_category_name as category_name')
            ->orderBy('transactions.start_date', 'desc')
            ->first();

        if(empty($transaction))
        {
            return redirect()->route('front.order');
        }

        if($transaction->status == 'Pending')
        {
            $status = 'Reserved';
        } else if($transaction->status == 'Confirmed')
        {
            $status = 'On Going';
        } else if($transaction->status == 'Done')
        {
            $status = 'Done';
        }


        return view('customer.orderStatusDetail', compact('transaction', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function extend(Request $request, $id)
    {
        $transaction = Transaction::with('user','vehicle', 'vehicleCategory')->findOrFail($id);

        $start_date = Carbon::createFromFormat('Y-m-d', $transaction->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d', $transaction->end_date)->addDays(1);

        $days = $start_date->diffInDays($end_date);

        $transaction->start_date = $start_date;
        $transaction->end_date = $end_date;
        $transaction->total_days = $days;
        $transaction->total_price = $transaction->total_price + $transaction->vehicle->rental_price * $days + ($transaction->vehicle->rental_price * $days * 0.1);;
        $transaction->save();

        return redirect()->route('front.order.show', $id);
    }
    public function rate()
    {

    }
}
