<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'price'       => ['required', 'int', 'min:0'],
            'img'         => ['file', 'mimes:jpg,jpeg,png,bmp', 'max:2048'],
            'description' => ['required', 'string'],
            'in_stock'    => ['required', 'boolean'],
        ];
    }
}
