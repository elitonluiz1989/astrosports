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
        if ($this->method() == 'POST') {
            $rules = [
                'id' => 'integer|unique:schedules-poles|nullable',
                'hour' => 'date_format:H:i|required',
                'day' => 'string|max:3|required',
                'pole' => 'integer|required',
                'category' => 'integer|required'
            ];
        } else {
            $rules = [
                'id' => 'integer|required',
                'hour' => 'date_format:H:i|required_without_all:day,pole,category',
                'day' => 'string|max:3|required_without_all:hour,pole,category',
                'pole' => 'integer|required_without_all:hour,day,category',
                'category' => 'integer|required_without_all:hour,day,pole'
            ];
        }

        return $rules;
    }
}
