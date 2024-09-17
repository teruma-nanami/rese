<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'post_code' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'cuisine_type' => ['required', 'string', 'max:255'],
            'detail' => ['nullable', 'string'],
            'owner_id' => ['required', 'exists:users,id'],
        ];
    }
}
