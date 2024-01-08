<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VoucherCategory;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherCategoryRequest;

class VoucherCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // script untuk datatables, dengan AJAX
        if (request()->ajax()) {
            $query = VoucherCategory::query();

            return DataTables::of($query)
                ->editColumn('thumbnail', function ($voucherCategory) {
                    return '<img src="' . $voucherCategory->thumbnail . '" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
                })
                ->addColumn('action', function ($voucherCategory) {
                    return '
                    <div class="flex justify-between">
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 rounded-md select-none borde ease focus:outline-none focus:shadow-outline hover:bg-blue-800"
                        href="' . route('admin.voucherCategories.show', $voucherCategory->slug) . '">
                        details
                    </a>
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.voucherCategories.edit', $voucherCategory->slug) . '">
                        edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.voucherCategories.destroy', $voucherCategory->id) . '" method="POST">
                    <button class="w-full px-2 py-1 mx-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        delete
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>
                    </div>
                    ';
                })

                ->rawColumns(['action', 'thumbnail'])  //untuk munculin column yang dibuat diatas terender dengan baik
                ->make();
        }

        // script untuk return view
        return view('admin.voucherCategories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voucherCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherCategoryRequest $request)
    {
        $data = $request->all();
        // return dd($data);

        $data['slug'] = Str::slug($data['voucher_name']) . '-' . Str::lower(Str::random(5));

        // upload multiple pictures
        if ($request->hasFile('voucher_picture')) {
            $voucherPicture = $request->file('voucher_picture')->store('assets/item', 'public');
            $data['voucher_picture'] = json_encode($voucherPicture);
        }

        // return dd($data);

        VoucherCategory::create($data);

        return redirect()->route('admin.voucherCategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $voucherCategory = VoucherCategory::where('slug', $slug)->firstOrFail();

        return view('admin.voucherCategories.show', [
            'voucherCategory' => $voucherCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $voucherCategory = VoucherCategory::where('slug', $slug)->firstOrFail();

        return view('admin.voucherCategories.edit', [
            'voucherCategory' => $voucherCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherCategoryRequest $request, VoucherCategory $voucherCategory)
    {
        $data = $request->all();
        // dd($data);

        if ($request->hasFile('voucher_picture')) {
            $voucher_picture = $request->file('voucher_picture')->store('assets/item', 'public');
            $data['voucher_picture'] = json_encode($voucher_picture);
        } else {
            $data['voucher_picture'] = $voucherCategory->voucher_picture;
        }
        $voucherCategory->update($data);

        return redirect()->route('admin.voucherCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VoucherCategory $voucherCategory)
    {
        $voucherCategory->delete();
        return redirect()->route('admin.voucherCategories.index');
    }
}
