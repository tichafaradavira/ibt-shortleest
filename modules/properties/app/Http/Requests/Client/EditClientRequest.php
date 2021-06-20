<?php

namespace Modules\Properties\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class EditClientRequest extends FormRequest
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
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'summary' => '',
            'description' => '',
            'physical_address_street' => 'required',
            'physical_address_city' => 'required',
            'physical_address_surburb' => 'required',
            'physical_address_postcode' => 'required',
            'postal_equal_to_physical' => 'required|boolean',
            'postal_address_street' => 'required_if:postal_equal_to_physical,false',
            'postal_address_city' => 'required_if:postal_equal_to_physical,false',
            'postal_address_surburb' => 'required_if:postal_equal_to_physical,false',
            'postal_address_postcode' => 'required_if:postal_equal_to_physical,false',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
