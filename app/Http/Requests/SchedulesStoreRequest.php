<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulesStoreRequest extends FormRequest
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
            'id' => 'integer|unique:schedules-poles|nullable',
            'hour' => 'date_format:H:i|required',
            'day' => 'string|max:3|required',
            'pole' => 'integer|required',
            'category' => 'integer|required'
        ];
    }
}
