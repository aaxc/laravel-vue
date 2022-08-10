<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name.value'       => ['required', 'max:255'],
            'email.value'      => ['required', 'email', 'unique:users,email', 'max:255'],
            'created_at.value' => ['required', 'date'],
            'updated_at.value' => ['required', 'date'],
            'password.value'   => ['required'],
        ];
    }
}
