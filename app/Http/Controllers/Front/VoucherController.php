<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VoucherCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        $data = VoucherCategory::with('vouchers', 'vouchers.user')->paginate(5);
        return view('customer.voucher', compact('data', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $newVoucher = [
            'voucher_category_id' => $id,
            'user_id' => auth()->user()->id,
            'qty' => 1,
        ];

        $user = auth()->user();
        // Ensure user exists
        if ($user) {
            $User = User::findOrFail($user->id);

            // Ensure voucher exists
            $voucher = VoucherCategory::findOrFail($id);

            if ($User && $voucher) {
                // Check if user has sufficient experience points
                if ($User->experience_point >= $voucher->voucher_price) {
                    // Use a database transaction for data consistency
                    try {
                        DB::beginTransaction();

                        // Subtract experience points
                        $User->experience_point -= $voucher->voucher_price;
                        $User->save();
                        $voucher->vouchers()->create($newVoucher);
                        // Your code to create the voucher transaction goes here

                        DB::commit();

                        // Success message or redirection
                        return redirect()->route('front.voucher')->with('success', 'Voucher purchased successfully!');
                    } catch (\Exception $e) {
                        DB::rollback();

                        // Handle the exception (e.g., log, display error message)
                        return redirect()->route('front.voucher')->with('error', 'Failed to purchase voucher.');
                    }
                } else {
                    // Insufficient experience points
                    return redirect()->route('front.voucher')->with('error', 'Insufficient experience points.');
                }
            } else {
                // User or voucher not found
                return redirect()->route('front.voucher')->with('error', 'User or voucher not found.');
            }
        } else {
            // User not authenticated
            return redirect()->route('front.voucher')->with('error', 'User not authenticated.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
