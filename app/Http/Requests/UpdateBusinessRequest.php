<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'name'          => ['required', 'string'],
            // 'image'         => ['required', 'image', 'max:512'],
            // 'is_closed'     => ['required', 'boolean'],
            // 'lattitude'     => ['required'],
            // 'longtitude'    => ['required'],
            // 'price'         => ['required'],
            // 'phone'         => ['required', 'string'],
            // 'display_phone' => ['required', 'string'],
            // 'distance'      => ['required'],
            // 'address1'      => ['required', 'string'],
            // 'city'          => ['required', 'string'],
            // 'zip_code'      => ['required', 'string'],
            // 'country'       => ['required', 'string'],
            // 'state'         => ['required', 'string'],
            // 'categories'    => ['required'],
            // 'transactions'  => ['required']
        ];
    }
}
