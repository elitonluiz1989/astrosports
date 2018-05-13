<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulesDefaultStoreRequest extends FormRequest
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
        $table = (strpos($this->getRequestUri(), 'poles')) ? 'schedules_poles' : 'schedules_categories';

        if ($this->method() == 'POST') {
            return [
                'name' => "string|unique:{$table}|required"
            ];
        } else {
            return [
                'id' => 'integer|required',
                'name' => "string|unique:{$table}|required"
            ];
        }
    }

    public function messages()
    {
        $target = (strpos($this->getRequestUri(), 'poles')) ? 'do polo' : 'da categoria';

        return [
            'name.unique' => "[show-user]O nome '{$this->get('name')}' já existe."
        ];
    }
}
