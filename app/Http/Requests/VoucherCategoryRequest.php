<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class VoucherCategoryRequest extends FormRequest
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
            'voucher_name' => 'required|string|max:255',
            'voucher_nominal' => 'required|numeric|min:1|max:10000000',
            'voucher_price' => 'required|numeric|min:1|max:1000',
            'expired_date' => 'required|date',
            'minimum_spending' => 'required|numeric|min:1|max:10000000',
            'voucher_picture' => 'nullable',
            'voucher_picture.*' => 'nullable | image | mimes : jpg ,jpeg,png |max:2048',
        ];
    }
}
