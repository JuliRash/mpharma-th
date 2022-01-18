<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosisRequest extends FormRequest
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
            'category_code' => 'required',
            'category_title' => 'required',
            'diagnosis_code' => 'required',
            'full_code' => 'required',
            'abbreviated_description' => 'required',
            'full_description' => 'required',
        ];
    }
}
