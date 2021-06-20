<?php

namespace Modules\Properties\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Property extends JsonResource
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
            'property_type' => $this->property_type,
            'type' => $this->type,
            'area' => $this->area,
            'rental_price' => $this->rental_price,
            'description' => $this->description,
            'client' => new Client($this->whenLoaded('client')),
            'physical_address_street' => $this->physical_address_street,
            'physical_address_city' => $this->physical_address_city,
            'physical_address_surburb' =>  $this->physical_address_surburb,
            'physical_address_postcode' => $this->physical_address_postcode,
            'postal_equal_to_physical' => $this->postal_equal_to_physical,
            'postal_address_street' => $this->postal_address_street,
            'postal_address_city' => $this->postal_address_city,
            'postal_address_surburb' =>  $this->postal_address_surburb,
            'postal_address_postcode' => $this->postal_address_postcode,
            'created_at'=> $this->created_at,

        ];
    }

}
