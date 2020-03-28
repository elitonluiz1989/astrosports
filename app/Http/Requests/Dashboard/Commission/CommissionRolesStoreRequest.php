<?php

namespace App\Http\Requests\Dashboard\Commission;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRolesStoreRequest extends FormRequest
{
    /**
     * Determine if the Commission is authorized to make this request.
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

            return [
                'id' => 'integer|required',
                'name' => "string|required"
            ];
        } else {
            return [
                'name' => "string|required"
            ];
        }
    }
}
