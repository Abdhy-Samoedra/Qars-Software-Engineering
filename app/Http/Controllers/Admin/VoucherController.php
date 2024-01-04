<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Voucher::query();

            return DataTables::of($query)
                ->editColumn('thumbnail', function ($voucher) {
                    return '<img src="' . $voucher->thumbnail . '" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
                })
                ->addColumn('action', function ($voucher) {

                    return '
                    <div class="flex justify-between">
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 rounded-md select-none borde ease focus:outline-none focus:shadow-outline hover:bg-blue-800"
                        href="' . route('admin.vouchers.show', $voucher->user_id) . '">
                        details
                    </a>
                    </div>
                    ';
                })

                ->rawColumns(['action', 'thumbnail'])  //untuk munculin column yang dibuat diatas terender dengan baik
                ->make();
        }



        return view('admin.vouchers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($user_id)
    {
        $voucher = Voucher::where('user_id', $user_id)->firstOrFail();
        return view('admin.vouchers.show', [
            'voucher' => $voucher
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user_id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
