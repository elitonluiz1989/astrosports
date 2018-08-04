<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersDefaultStoreRequest extends FormRequest
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
        $table = (strpos($this->getRequestUri(), 'grants')) ? 'user_grants' : 'user_roles';

        if ($this->method() == 'POST') {
            return [
                'name' => "string|unique:{$table},name|required"
            ];
        } else {
            return [
                'id' => 'integer|required',
                'name' => "string|unique:{$table},name,{$this->get('id')}|required"
            ];
        }
    }

    public function messages()
    {
        return [
            'name.unique' => "[show-user]O nome \"{$this->get('name')}\" já existe."
        ];
    }
}
