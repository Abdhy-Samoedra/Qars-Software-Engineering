<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Rating;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user_id = auth()->user()->id;

        $status = $request->get('status');

        if (!isset($status)) {
            $status = 'Pending';
        }

        if ($status == 'reserved') {
            $status = 'Pending';
        } else if ($status == 'ongoing') {
            $status = 'Confirmed';
        } else if ($status == 'done') {
            $status = 'Done';
        }


        $data = Transaction::with('vehicle', 'vehicle.vehicleCategory')->where('user_id', $user_id)->where('status', $status)->paginate(12);
        // dd($data);
        return view('customer.orderListPage', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!auth()->check()) {
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
                'vehicle_categories.vehicle_category_name as category_name'

            )
            ->orderBy('transactions.start_date', 'desc')
            ->first();

        if (empty($transaction)) {
            return redirect()->route('front.order');
        }

        if ($transaction->status == 'Pending') {
            $status = 'Reserved';
        } else if ($transaction->status == 'Confirmed') {
            $status = 'On Going';
        } else if ($transaction->status == 'Done') {
            $status = 'Done';
        }

        $user = auth()->user();

        // Alternative way
        // $ratings = Rating::join('transactions', 'transactions.id', '=', 'ratings.transactions_id')
        //     ->where('ratings.transactions_id', '=', $id)
        //     ->select('ratings.*', 'transactions.id as transaction_id')
        //     ->first();

        $product = Rating::join('transactions', 'transactions.id', '=', 'ratings.transactions_id')
            ->join('vehicles', 'vehicles.id', '=', 'transactions.vehicle_id')
            ->where('ratings.transactions_id', '=', $id)
            ->get();

        $exists = Rating::where('transactions_id', $id)->exists();

        $rating = Rating::where('transactions_id', $id)->get()->first();


        return view('customer.orderStatusDetail', compact('transaction', 'status', 'user', 'id', 'exists', 'rating'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function extend(Request $request, $id)
    {
        // dd($request->all());
        $transaction = Transaction::with('user', 'vehicle', 'vehicle.vehicleCategory')->findOrFail($id);
        // dd($transaction);

        // handle midtrans payment_method
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        // get usd to idr rate from https://www.exchangerate-api.com/ using guzzle
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.exchangerate-api.com/v4/latest/USD');
        $body = $response->getBody();
        $rate = json_decode($body)->rates->IDR;

        //convert to idr
        $totalPrice = $transaction->vehicle->rental_price;

        // create midtrans params
        //docs : https://api-docs.midtrans.com/#request-body-json-attributes
        $midtransParams = [
            'transaction_details' => [
                'order_id' => "extend-" . $transaction->id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
                'phone' => $transaction->user->phone,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer', 'shopeepay', 'echannel', 'indomaret', 'akulaku', 'credit_card'],
        ];


        $start_date = Carbon::createFromFormat('Y-m-d', $transaction->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d', $transaction->end_date)->addDays(1);

        $days = $start_date->diffInDays($end_date);

        $transaction->start_date = $start_date;
        $transaction->end_date = $end_date;
        $transaction->total_days = $days;
        $transaction->total_price = $transaction->vehicle->rental_price * $days + ($transaction->vehicle->rental_price * $days * 0.1);
        $transaction->extend = 1;
        $transaction->save();

        // get snap payment page URL
        $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;
        // dd($paymentUrl);

        // save snap payment page URL to booking
        // $transaction->payment_url = $paymentUrl;

        //save booking
        // $transaction->save();

        // redirect to snap payment page
        return redirect($paymentUrl);




        // return redirect()->route('front.orderDetail', $id);
    }
    public function rate(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $transaction = Transaction::findOrFail($id);

        $transaction_id = $transaction->id;
        $stars_rated = $request->input('product_rating');
        $description = $request->input('desc');


        if ($transaction->user_id == auth()->user()->id) {
            // Check if the transaction is done and the payment is success
            if ($transaction->status == 'Done') {
                // Check if the transaction ID is already rated, if yes, return error
                if (Rating::where('transactions_id', $id)->first()) {
                    return redirect()->back()->withErrors(['status' => 'The transaction ID already exists. Cannot rate anymore']);
                } else {
                    Rating::create([
                        'transactions_id' => $transaction_id,
                        'review' => $description,
                        'rating' => $stars_rated,
                        'created_at' => now(),
                    ]);
                    return redirect()->back();
                }
            } else {

                return redirect()->back()->with('status', 'Your rent is not finished !');
            }
        } else {
            return redirect()->back()->with('status', 'Error, You cannot rate a car that you did not rent');
        }

        //get vehicle rating and calculate with new rating

    }
}
