<?php

namespace App\Http\Requests\Dashboard\Users;

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
        if ($this->has('id')) {
            $id = $this->get('id');

            return [
                'id'       => 'integer|required',
                'avatar'   => 'string|required_without_all:username,name,role,password',
                'username' => "string|unique:users,username,{$id}|required_without_all:avatar,name,role,password",
                'name'     => 'string|required_without_all:avatar,username,role,password',
                'role'     => 'integer|required_without_all:avatar,username,name,password',
                'password' => 'string|confirmed|required_without_all:avatar,username,name,role',
            ];
        } else {
            return [
                'avatar'   => 'string|nullable',
                'username' => 'string|unique:users,username|required',
                'name'     => 'string|nullable',
                'role'     => 'integer|required',
                'password' => 'string|confirmed|required',
            ];
        }
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        $username = $this->get('username');

        return [
            'username.unique' => "[show-user]O nome de usuário \"{$username}\" já foi usado."
        ];
    }
}
