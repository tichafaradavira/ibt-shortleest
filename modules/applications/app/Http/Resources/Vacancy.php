<?php

namespace Modules\Applications\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Properties\Http\Resources\Property;

class Vacancy extends JsonResource
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
            'property' => new Property($this->whenLoaded('property')),
            'status' => $this->vacancy_status,
            'token' => $this->token,
            'link' => $this->link,
            'available_from' => $this->available_from,
            'created_at'=> $this->created_at,

        ];
    }

}
