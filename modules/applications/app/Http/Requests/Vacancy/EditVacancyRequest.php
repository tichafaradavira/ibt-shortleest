<?php

namespace Modules\Applications\Http\Requests\Vacancy;

use Illuminate\Foundation\Http\FormRequest;

class EditVacancyRequest extends FormRequest
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
            'property' => 'required',
            'reference' => 'required',
            'status' => 'numeric',
            'available_from' => '',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
