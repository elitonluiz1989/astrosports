<?php

namespace App\Http\Requests\Dashboard\Schedules;

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

        if ($this->has('id')) {
            return [
                'id' => 'integer|required',
                'name' => "string|unique:{$table},name,{$this->get('id')}|required"
            ];
        } else {
            return [
                'name' => "string|unique:{$table},name|required"
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
