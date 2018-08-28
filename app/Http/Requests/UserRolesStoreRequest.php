<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRolesStoreRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'name' => "string|unique:user_roles,name|required",
                'grant' => "integer|required"
            ];
        } else {
            $id = $this->get('id');

            return [
                'id' => 'integer|required',
                'name' => "string|unique:user_roles,name,{$id}|required",
                'grant' => "integer|required"
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
        return [
            'name.unique' => "[show-user]O nome \"{$this->get('name')}\" já existe."
        ];
    }
}
