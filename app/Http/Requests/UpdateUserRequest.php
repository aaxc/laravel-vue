<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;
use App\Rules\FullNameRule;
use App\Rules\UniqueEmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

/**
 * Update user request rules
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
class UpdateUserRequest extends FormRequest
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
            'id.value'         => ['required', 'integer'],
            'name.value'       => [new FullNameRule()],
            'email.value'      => [new EmailRule()],
            'created_at.value' => ['date'],
            'updated_at.value' => ['date', 'required'],
        ];
    }
}
