<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Transaction;
use App\Http\Controllers\Controller;

class MidtransCallbackController extends Controller
{
    public function callback()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        //cut the order_id to get the transaction id
        $orderId = explode('-', $orderId);

        // dd($notification->transaction_status, $notification->payment_type, $notification->fraud_status, $notification->order_id);

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($orderId[1]);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->payment_status = 'pending';
                } else {
                    $transaction->payment_status = 'success';
                    $transaction->status = 'Confirmed';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->payment_status = 'success';
        } elseif ($status == 'pending') {
            $transaction->payment_status = 'pending';
        } elseif ($status == 'deny') {
            $transaction->payment_status = 'cancelled';
        } elseif ($status == 'expire') {
            $transaction->payment_status = 'cancelled';
        } elseif ($status == 'cancel') {
            $transaction->payment_status = 'cancelled';
        }

        // Simpan transaksi
        $transaction->save();

        // Return response
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success'
            ]
        ]);
    }
}