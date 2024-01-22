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
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->user),
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'regex:/(08)[0-9]*/',
                'min:10',
                'max:13',
                Rule::unique('users')->ignore($this->user)
            ]
        ];
    }
}
