<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\VehicleCategory;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // script untuk datatables, dengan AJAX
        if (request()->ajax()) {
            $query = Vehicle::query();

            return DataTables::of($query)
                ->editColumn('thumbnail', function ($vehicle) {
                    return '<img src="' . $vehicle->thumbnail . '" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
                })
                ->addColumn('action', function ($vehicle) {
                    return '
                    <div class="flex justify-between">
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 rounded-md select-none borde ease focus:outline-none focus:shadow-outline hover:bg-blue-800"
                        href="' . route('admin.vehicles.show', $vehicle->slug) . '">
                        details
                    </a>
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.vehicles.edit', $vehicle->slug) . '">
                        edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.vehicles.destroy', $vehicle->id) . '" method="POST">
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
        return view('admin.vehicles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicleCategory = VehicleCategory::all();
        return view('admin.vehicles.create', compact('vehicleCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        $data = $request->all();
        // return dd($data);

        $data['slug'] = Str::slug($data['id']) . '-' . Str::lower(Str::random(5));

        // upload multiple pictures
        // dd($request);
        if ($request->hasFile('car_picture')) {
            $car_picture = [];

            foreach ($request->file('car_picture') as $picture) {
                $vehiclePicturePath = $picture->store('assets/item', 'public');

                //push to array
                array_push($car_picture, $vehiclePicturePath);
            }


            $data['car_picture'] = json_encode($car_picture);
        }

        // return dd($data);
        Vehicle::create($data);

        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->firstOrFail();
        // dd(json_decode($vehicle->car_picture));
        return view('admin.vehicles.show', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->firstOrFail();
        $vehicleCategory = VehicleCategory::all();

        return view('admin.vehicles.edit', [
            'vehicle' => $vehicle,
            'vehicleCategory' => $vehicleCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->all();
        // dd($data);

        if ($request->hasFile('car_picture')) {

            $car_picture = [];

            foreach ($request->file('car_picture') as $picture) {
                $vehiclePicturePath = $picture->store('assets/item', 'public');

                //push to array
                array_push($car_picture, $vehiclePicturePath);
            }

            // $car_picture = $request->file('car_picture')->store('assets/item', 'public');
            $data['car_picture'] = json_encode($car_picture);
        } else {
            $data['car_picture'] = $vehicle->car_picture;
        }
        // dd($data);
        $vehicle->update($data);

        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index');
    }
}
