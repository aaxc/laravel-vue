<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;
use App\Rules\FullNameRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Store user request rules
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
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
            'name.value'       => ['required', new FullNameRule()],
            'email.value'      => ['required', new EmailRule(), 'unique:users,email'],
            'created_at.value' => ['required', 'date'],
            'updated_at.value' => ['required', 'date'],
            'password.value'   => ['required'],
        ];
    }
}
