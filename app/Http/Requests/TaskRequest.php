<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'description' => 'max:1024',
            'category_id' => 'required|integer',
            'project_id' => 'required|integer',
            'user_id' => 'nullable|integer',
            'order' => 'nullable|integer',
        ];
    }
}
