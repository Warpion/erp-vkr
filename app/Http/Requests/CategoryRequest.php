<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => 'required|max:255',
            'price' => 'required|integer',
            'rating' => 'required|integer',
            'max_rating' => 'required|integer',
            'skill_id' => 'nullable|integer',
            'time'  => 'required|date_format:H:i',
        ];
    }
}
