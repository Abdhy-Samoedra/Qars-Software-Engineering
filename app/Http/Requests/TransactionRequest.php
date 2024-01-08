<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TransactionRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'driver_id' => 'nullable|integer|exists:drivers,id',
            'vehicle_id' => 'required|string|exists:vehicles,id',
            'voucher_category_id' => 'nullable|integer|exists:voucher_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }
}
