<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'name' => 'required|string|max:255',
            // 'email' => [
            //     'required',
            //     'string',
            //     'email',
            //     'max:255',
            // ],
            // 'phone' => [
            //     'required',
            //     'string',
            //     'regex:/(08)[0-9]*/',
            //     'min:10',
            //     'max:13',
            // ],
            // 'age' => 'required|integer|min:1|max:200',
            // 'profile_photo_path' => 'nullable',
            // 'profile_photo_path.*' => 'nullable | image | mimes : jpg ,jpeg,png |max:2048',
            // 'driving_license_path' => 'nullable',
            // 'driving_license_path.*' => 'nullable | image | mimes : jpg ,jpeg,png |max:2048',
        ];
    }
}
