<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutletRequest extends FormRequest
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
            'name' => ['required', 'max:70'],
            'user_id' => ['required'],
            'phone' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'image' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "this is required", 
            'user_id.required' => "this is required",
            'phone.required' => "this is required",
            'latitude.required' => "this is required",
            'longitude.required' => "this is required",
            'image.required' => "this is required",
        ];
    }
}
