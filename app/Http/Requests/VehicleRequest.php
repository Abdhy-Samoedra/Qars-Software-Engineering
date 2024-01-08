<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'id' => 'required|string|min:3|max:12|regex:/[A-Z]+ [0-9]+ [A-Z]+/',
            'color' => 'required|string|min:3|max:20',
            'brand' => 'required|string|min:3|max:20',
            'type' => 'required|string|min:3|max:20',
            'year_of_release' => 'required|integer|min:1900|max:2025',
            'fuel' => 'required|string|min:3|max:20',
            'rental_price' => 'required|integer|min:100000|max:10000000',
            'car_description' => 'required|string|min:3|max:20000',
            'car_picture' => 'required|array|min:1|max:5',
        ];
    }
}
