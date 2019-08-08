<?php

namespace App\Http\Requests\Dashboard\Commission;

use Illuminate\Foundation\Http\FormRequest;

class CommissionStoreRequest extends FormRequest
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
                'name'     => 'string|required_without_all:avatar,username,role,password',
                'role'     => 'integer|required_without_all:avatar,username,name,password',
            ];
        } else {
            return [
                'avatar'   => 'string|nullable',
                'name'     => 'string|required',
                'role'     => 'integer|required',
            ];
        }
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages() { }
}
