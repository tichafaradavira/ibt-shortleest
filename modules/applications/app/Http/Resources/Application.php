<?php

namespace Modules\Applications\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Application extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public $preserveKeys = true;

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => '',
            'last_name' => $this->last_name,
            'nationality' => $this->nationality,
            'citizenship' => $this->citizenship,
            'dob' => $this->dob,
            'national_id' => $this->national_id,
            'gender' => $this->gender,
            'status' => $this->status,
            'application_status' => $this->application_status,

            'mobile_number' => $this->mobile_number,
            'home_number' => $this->home_number,
            'work_number' => $this->work_number,
            'email' => $this->email,
            'fax' => $this->fax,
            'vacancy' => new Vacancy($this->whenLoaded('vacancy')),

            'physical_address_street' => $this->physical_address_street,
            'physical_address_city' => $this->physical_address_city,
            'physical_address_surburb' => $this->physical_address_surburb,
            'physical_address_postcode' => $this->physical_address_postcode,
            'postal_equal_to_physical' => $this->postal_equal_to_physical,

            'next_of_kin_name' => $this->next_of_kin_name ,
            'next_of_kin_email'=> $this->next_of_kin_email,
            'next_of_kin_phone'=> $this->next_of_kin_phone,
            'next_of_kin_address'=> $this->next_of_kin_address,

            'postal_address_street' => $this->postal_address_street,
            'postal_address_city' => $this->postal_address_city,
            'postal_address_surburb' => $this->postal_address_surburb,
            'postal_address_postcode' => $this->postal_address_postcode,

            'employment_status' => $this->employment_status,
            'employer_name' => $this->employer_name,
            'employer_phone' => $this->employer_phone,
            'employer_email' => $this->employer_email,
            'employer_address' => $this->employer_address,
            'gross_salary' => $this->gross_salary,
            'created_at'=> $this->created_at,

            'dependants' => $this->dependants,
            'reason_for_moving' => $this->reason_for_moving,
            'is_smoker' => $this->is_smoker,
            'has_pets' => $this->has_pets,

            'references' => $this->references,
            'expenses' => $this->expenses,

        ];
    }

}
