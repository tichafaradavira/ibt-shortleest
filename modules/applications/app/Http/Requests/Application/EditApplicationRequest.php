<?php

namespace Modules\Applications\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class EditApplicationRequest extends FormRequest
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

            'first_name' => 'required',
            'middle_name' => '',
            'last_name' => 'required',
            'nationality' => 'required',
            'citizenship' => 'required',
            'dob' => 'required',
            'national_id' => 'required',
            'gender' => 'required',

            'mobile_number' => 'required',
            'home_number' => '',
            'work_number' => '',
            'email' => 'required',
            'fax' => '',

            'physical_address_street' => 'required',
            'physical_address_city' => 'required',
            'physical_address_surburb' => 'required',
            'physical_address_postcode' => 'required',
            'postal_equal_to_physical' => 'required|boolean',

            'postal_address_street' => 'required_if:postal_equal_to_physical,false',
            'postal_address_city' => 'required_if:postal_equal_to_physical,false',
            'postal_address_surburb' => 'required_if:postal_equal_to_physical,false',
            'postal_address_postcode' => 'required_if:postal_equal_to_physical,false',

            'employment_status' => 'required',
            'employer_name' => '',
            'employer_address' => '',
            'gross_salary' => '',

        ];

    }

    public function messages()
    {
        return [
        ];
    }
}
