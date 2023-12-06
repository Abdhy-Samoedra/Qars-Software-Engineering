<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\DriverRequest;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // script untuk datatables, dengan AJAX
        if (request()->ajax()) {
            $query = Driver::query();

            return DataTables::of($query)
                ->editColumn('thumbnail', function ($driver) {
                    return '<img src="' . $driver->thumbnail . '" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
                })
                ->addColumn('action', function ($driver) {
                    return '
                    <div class="flex justify-between">
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 rounded-md select-none borde ease focus:outline-none focus:shadow-outline hover:bg-blue-800"
                        href="' . route('admin.drivers.show', $driver->slug) . '">
                        details
                    </a>
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.drivers.edit', $driver->slug) . '">
                        edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.drivers.destroy', $driver->id) . '" method="POST">
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
        return view('admin.Drivers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));


        // upload multiple pictures
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture')->store('assets/item', 'public');
            $data['picture'] = json_encode($picture);
        }
        Driver::create($data);

        return redirect()->route('admin.drivers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $driver = Driver::where('slug', $slug)->firstOrFail();

        $driver['picture'] = json_decode($driver->picture);

        return view('admin.drivers.show', [
            'driver' => $driver,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $driver = Driver::where('slug', $slug)->firstOrFail();

        return view('admin.drivers.edit', [
            'driver' => $driver,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverRequest $request, Driver $driver)
    {
        $data = $request->all();

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture')->store('assets/item', 'public');
            $data['picture'] = json_encode($picture);
        } else {
            $data['picture'] = $driver->picture;
        }
        $driver->update($data);

        return redirect()->route('admin.drivers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index');
    }
}
