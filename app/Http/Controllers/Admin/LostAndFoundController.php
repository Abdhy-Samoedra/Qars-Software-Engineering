<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostAndFound;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class LostAndFoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // script untuk datatables, dengan AJAX
        if (request()->ajax()) {
            $query = LostAndFound::query();

            return DataTables::of($query)
                ->editColumn('thumbnail', function ($LostandFound) {
                    return '<img src="' . $LostandFound->thumbnail . '" alt="Thumbnail" class="w-20 mx-auto rounded-md">';
                })
                ->addColumn('action', function ($LostandFound) {
                    return '
                    <div class="flex justify-between">
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 rounded-md select-none borde ease focus:outline-none focus:shadow-outline hover:bg-blue-800"
                        href="' . route('admin.lostAndFounds.show', $LostandFound->slug) . '">
                        details
                    </a>
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.lostAndFounds.edit', $LostandFound->slug) . '">
                        edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.lostAndFounds.destroy', $LostandFound->id) . '" method="POST">
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
        return view('admin.lostAndFounds.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lostAndFounds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // return dd($data);

        $data['slug'] = Str::slug($data['lost_and_found_picture']) . '-' . Str::lower(Str::random(5));

        // upload multiple pictures
        if ($request->hasFile('lost_and_found_picture')) {
            $LostAndFoundPicture = $request->file('lost_and_found_picture')->store('assets/item', 'public');
            $data['lost_and_found_picture'] = json_encode($LostAndFoundPicture);
        }

        // return dd($data);

        LostAndFound::create($data);

        return redirect()->route('admin.lostAndFounds.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $lostAndFound = LostAndFound::where('slug', $slug)->firstOrFail();

        return view('admin.lostAndFounds.show', [
            'lostAndFound' => $lostAndFound,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $lostAndFound = LostAndFound::where('slug', $slug)->firstOrFail();

        return view('admin.lostAndFounds.edit', [
            'lostAndFound' => $lostAndFound,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LostAndFound $lostAndFound)
    {
        $data = $request->all();
        // dd($data);

        if ($request->hasFile('lost_and_found_picture')) {
            $lost_and_found_picture = $request->file('lost_and_found_picture')->store('assets/item', 'public');
            $data['lost_and_found_picture'] = json_encode($lost_and_found_picture);
        } else {
            $data['lost_and_found_picture'] = $lostAndFound->lost_and_found_picture;
        }
        $lostAndFound->update($data);

        return redirect()->route('admin.lostAndFounds.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LostAndFound $lostAndFound)
    {
        $lostAndFound->delete();
        return redirect()->route('admin.lostAndFounds.index');
    }
}
