<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest
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
            'avatar'   => 'string|nullable',
            'username' => 'string|required',
            'name'     => 'string|nullable',
            'role'     => 'integer|required',
            'password' => 'string|confirmed|required',
        ];
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.confirmed' => "[show-user]As senhas informadas diferem."
        ];
    }
}
