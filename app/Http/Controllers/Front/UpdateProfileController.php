<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Validation\Rule;

class UpdateProfileController extends Controller
{
    public function updateProfile(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        // Get all input data
        $data = $request->all();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($user->id),
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'regex:/(08)[0-9]*/',
                'min:10',
                'max:13',
                Rule::unique('users')->ignore($user->id)
            ],
            'age' => 'required|integer|min:1|max:200',
            'profile_photo_path' => 'nullable',
            'profile_photo_path.*' => 'nullable | image | mimes : jpg ,jpeg,png |max:2048',
        ]);

        if ($request->hasFile('profile_photo_path')) {
            $profilePhotoPath = $request->file('profile_photo_path')->store('assets/item', 'public');
            $data['profile_photo_path'] = json_encode($profilePhotoPath);
        }

        // Update the user with the validated data
        $user->update($data);

        return redirect()->back()->with('message', 'Profile Updated Successfully');
    }

    public function updateDrivingLicense(Request $request, $id)
    {
        $user = User::findOrFail($request->id);
        $data = $request->all();
        $data = $request->validate([
            'driving_license_path' => 'nullable',
            'driving_license_path.*' => 'nullable | image | mimes : jpg ,jpeg,png |max:2048',
        ]);
        if ($request->hasFile('driving_license_path')) {
            $drivingLicensePath = $request->file('driving_license_path')->store('assets/item', 'public');
            $data['driving_license_path'] = json_encode($drivingLicensePath);
        }
        $user->update($data);
        return redirect()->back()->with('message', 'Driving License Updated Successfully');
    }
}
