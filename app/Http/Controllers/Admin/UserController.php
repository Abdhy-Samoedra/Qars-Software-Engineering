<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // script untuk datatables, dengan AJAX
        if (request()->ajax()) {
            $query = User::query();

            return DataTables::of($query)
                ->addColumn('action', function ($user) {
                    return '
                    <div class="flex justify-between">
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-blue-500 rounded-md select-none borde ease focus:outline-none focus:shadow-outline hover:bg-blue-800"
                        href="' . route('admin.users.show', $user->slug) . '">
                        details
                    </a>
                    <a class="block w-full px-2 py-1 mx-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('admin.users.edit', $user->slug) . '">
                        edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.users.destroy', $user->id) . '" method="POST">
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
        return view('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $user['profile_photo_path'] = json_decode($user->profile_photo_path);

        $user['driving_license_path'] = json_decode($user->driving_license_path);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $user['profile_photo_path'] = json_decode($user->profile_photo_path);

        $user['driving_license_path'] = json_decode($user->driving_license_path);

        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();

        // dd($user->phone, $request->phone);
        //validasi emailnya sama dengan yang lain atau tidak
        // $data = $request->validate([
        //     'email' => [Rule::unique('users')->ignore($user->email)],
        //     'phone' => [Rule::unique('users')->ignore($user->phone)],
        // ]);
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => [
                'required',
                'string',
                'regex:/(08)[0-9]*/',
                'min:10',
                'max:13',
                Rule::unique('users')->ignore($user->id),
            ],
            'age' => 'required|integer|min:1|max:200',
            'profile_photo_path' => 'nullable',
            'profile_photo_path.*' => 'nullable | image | mimes : jpg ,jpeg,png |max:2048',
            'driving_license_path' => 'nullable',
            'driving_license_path.*' => 'nullable | image | mimes : jpg ,jpeg,png |max:2048'
        ]);

        dd($data);
        // upload multiple pictures
        if ($request->hasFile('profile_photo_path')) {
            $profilePhotoPath = $request->file('profile_photo_path')->store('assets/item', 'public');
            $data['profile_photo_path'] = json_encode($profilePhotoPath);
        } else {
            $data['profile_photo_path'] = $user->profile_photo_path;
        }

        if ($request->hasFile('driving_license_path')) {
            $drivingLicensePath = $request->file('driving_license_path')->store('assets/item', 'public');
            $data['driving_license_path'] = json_encode($drivingLicensePath);
        } else {
            $data['driving_license_path'] = $user->driving_license_path;
        }

        dd($data);
        $user->update($data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
