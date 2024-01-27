<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'money' => 'required|numeric|min:1',
            'name' => 'required|string|min:3|max:20'
        ];
    }
}
