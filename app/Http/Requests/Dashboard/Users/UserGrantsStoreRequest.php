<?php

namespace App\Http\Requests\Dashboard\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserGrantsStoreRequest extends FormRequest
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
                'id' => 'integer|required',
                'name' => "string|unique:user_grants,name,{$id}|required"
            ];
        } else {
            return [
                'name' => "string|unique:user_grants|required"
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
