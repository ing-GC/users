<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => ['required', 'string', 'min:2', 'max:255'],
            'email'         => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'password'      => ['required', 'string', 'min:8', 'max:64'],
            'date_of_birth' => ['required', 'date_format:Y-m-d'],
        ];
    }
}
