<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VehicleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // script untuk datatables, dengan AJAX
        if (request()->ajax()) {
            $query = VehicleCategory::query();

            return DataTables::of($query)
                ->editColumn('thumbnail', function ($vehicleCategory) {
                    return '<img src="' . $vehicleCategory->thumbnail . '" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
                })
                ->addColumn('action', function ($vehicleCategory) {
                    return '
                    <div class="flex justify-between">
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 rounded-md select-none borde ease focus:outline-none focus:shadow-outline hover:bg-blue-800"
                        href="' . route('admin.vehicleCategories.show', $vehicleCategory->slug) . '">
                        details
                    </a>
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.vehicleCategories.edit', $vehicleCategory->slug) . '">
                        edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.vehicleCategories.destroy', $vehicleCategory->id) . '" method="POST">
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
        return view('admin.vehicleCategories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicleCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // return dd($data);

        $data['slug'] = Str::slug($data['vehicle_category_name']) . '-' . Str::lower(Str::random(5));

        // upload multiple pictures
        if ($request->hasFile('vehicle_category_picture')) {
            $vehicleCategoryPicture = $request->file('vehicle_category_picture')->store('assets/item', 'public');
            $data['vehicle_category_picture'] = json_encode($vehicleCategoryPicture);
        }

        // return dd($data);

        VehicleCategory::create($data);

        return redirect()->route('admin.vehicleCategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $vehicleCategory = VehicleCategory::where('slug', $slug)->firstOrFail();

        return view('admin.vehicleCategories.show', [
            'vehicleCategory' => $vehicleCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $vehicleCategory = VehicleCategory::where('slug', $slug)->firstOrFail();

        return view('admin.vehicleCategories.edit', [
            'vehicleCategory' => $vehicleCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleCategory $vehicleCategory)
    {
        $data = $request->all();
        // dd($data);

        if ($request->hasFile('vehicle_category_picture')) {
            $vehicle_category_picture = $request->file('vehicle_category_picture')->store('assets/item', 'public');
            $data['vehicle_category_picture'] = json_encode($vehicle_category_picture);
        } else {
            $data['vehicle_category_picture'] = $vehicleCategory->vehicle_category_picture;
        }
        $vehicleCategory->update($data);

        return redirect()->route('admin.vehicleCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleCategory $vehicleCategory)
    {
        $vehicleCategory->delete();
        return redirect()->route('admin.vehicleCategories.index');
    }
}
