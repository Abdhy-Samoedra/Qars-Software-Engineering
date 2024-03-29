<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request, $transactionId)
    {
        $transaction = Transaction::with('vehicle', 'driver')->findOrFail($transactionId);
        $totalPrice = $transaction->total_price;

        // get data vouchers from user
        // $vouchers = Voucher::with('voucher_category')->where('user_id', auth()->user()->id)->where('voucher_category_id.voucher_category.minimum_spending','<=',$totalPrice)->get();
        // dd($vouchers);
        // $vouchers = Voucher::with('voucher_category')->where('user_id', auth()->user()->id)->get();
        // $validVoucher = VoucherCategory::where('minimum_spending','<=',$totalPrice)->get();
        // dd($validVoucher);

        // Get all vouchers with their associated voucher categories for the user
        $vouchers = Voucher::with('voucher_category')->where('user_id',  auth()->user()->id)->get();

        // Get valid voucher categories based on the minimum spending condition
        $validVoucherCategories = VoucherCategory::where('minimum_spending', '<=', $totalPrice)->pluck('id');

        // Filter the vouchers to include only those with valid voucher categories
        $validVouchers = $vouchers->filter(function ($voucher) use ($validVoucherCategories) {
            return $validVoucherCategories->contains($voucher->voucher_category->id);
        });
        // dd($validVouchers);
        //convert date to carbon
        // $transaction->start_date = Carbon::createFromFormat('d m Y', $transaction->start_date);
        // $transaction->end_date = Carbon::createFromFormat('d m Y', $transaction->start_date);
        return view('customer.payment', compact('transaction', 'validVouchers'));
    }

    public function update(Request $request, $transactionId)
    {
        // laod booking data
        $transaction = Transaction::findOrFail($transactionId);

        // dd($transaction->exp_reward);
        $user = User::findOrFail(Auth::user()->id);
        $user->experience_point += $transaction->exp_reward;
        $user->save();

        // dd($request->voucher_category_id);


        // check if request has voucher
        if ($request->voucher_category_id) {
            // get voucher data
            $transaction->voucher_category_id  = $request->voucher_category_id;
            $voucher = VoucherCategory::findOrFail($request->voucher_category_id);
            // dd($voucher->voucher_nominal);

            $voucherNominal = $voucher->voucher_nominal;

            // calculate total price
            $totalPrice = $transaction->total_price - $voucherNominal;

            // update total price   
            $transaction->total_price = $totalPrice;
        }




        // set payment method
        $transaction->payment_method = 'midtrans';

        // handle midtrans payment_method
        if ($transaction->payment_method == 'midtrans') {
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
            $totalPrice = $transaction->total_price;

            // create midtrans params
            //docs : https://api-docs.midtrans.com/#request-body-json-attributes
            $midtransParams = [
                'transaction_details' => [
                    'order_id' => "booking-".$transaction->id,
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $transaction->user->name,
                    'email' => $transaction->user->email,
                    'phone' => $transaction->user->phone,
                ],
                'enabled_payments' => ['gopay', 'bank_transfer', 'shopeepay', 'echannel', 'indomaret', 'akulaku', 'credit_card'],
            ];


            // get snap payment page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // save snap payment page URL to booking
            $transaction->payment_url = $paymentUrl;

            //save booking
            $transaction->save();


            //disable selected cars
            if ($transaction->driver_id) {
                $transaction->driver->status = 'unavailable';
                $transaction->driver->save();
            }
            $transaction->vehicle->status = 1;
            $transaction->vehicle->save();

            //drop data voucher from user
            if ($request->voucher_category_id) {
                $voucher = Voucher::where('user_id', auth()->user()->id)->where('voucher_category_id', $request->voucher_category_id);
                $voucher->delete();
            }

            // redirect to snap payment page
            return redirect($paymentUrl);
        }
    }

    public function success(Request $request)
    {
        // dd("yuegjh");
        // dd($request->all());
        // get transaction id from midtrans
        // $transactionId = $request->order_id;
        // get transaction
        // $transaction = Transaction::findOrFail($transactionId);
        // set transaction status to paid
        // $transaction->status = 'paid';
        // save transaction
        // $transaction->save();
        // redirect to payment success page
        return view('customer.paymentSuccess');
        // return view('customer.paymentFailed');
        // return view('customer.paymentProcessed');
    }

    public function error(Request $request)
    {
        // dd("yuegjh");
        // dd($request->all());
        // get transaction id from midtrans
        // $transactionId = $request->order_id;
        // get transaction
        // $transaction = Transaction::findOrFail($transactionId);
        // set transaction status to paid
        // $transaction->status = 'paid';
        // save transaction
        // $transaction->save();
        // redirect to payment success page
        // return view('customer.paymentSuccess');
        return view('customer.paymentFailed');
        // return view('customer.paymentProcessed');
    }

    public function processed(Request $request)
    {
        // dd("yuegjh");
        // dd($request->all());
        // get transaction id from midtrans
        // $transactionId = $request->order_id;
        // get transaction
        // $transaction = Transaction::findOrFail($transactionId);
        // set transaction status to paid
        // $transaction->status = 'paid';
        // save transaction
        // $transaction->save();
        // redirect to payment success page
        // return view('customer.paymentSuccess');
        // return view('customer.paymentFailed');
        return view('customer.paymentProcessed');
    }
}
