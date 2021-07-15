<?php

namespace Modules\Properties\Services;

use Modules\Applications\Models\Vacancy;
use Modules\Properties\Models\Property;
use Modules\Properties\Repositories\PropertyRepository;

class PropertyService
{
    protected $repository;
    protected $realtor;

    function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
        $this->realtor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $properties = $this->repository->browse($inputs, $this->realtor);

        return $properties;
    }

    function add($inputs)
    {
        $property = $this->repository->add($inputs, $this->realtor);

        if ($property) {
            return $property;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $property = Property::query()
        ->where('user_id', $this->realtor->id)
        ->where('id',$id)
        ->first();

        if ($property) {
            $property = $this->repository->edit($inputs, $property);
            return $property;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $property = $this->repository->read($id, $this->realtor);
            return $property;
        } else {
            return false;
        }
    }


    function delete($id)
    {



        if ($id) {
            $property = $this->repository->delete($id, $this->realtor);
            return $property;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $property = $this->repository->restore($id, $this->realtor);
            return $property;
        } else {
            return false;
        }
    }

    function hasActiveVacancy($id)
    {
        $vacancy = Vacancy::where('property_id', $id)
            ->where('status', Vacancy::STATUS_ACTIVE)
            ->first();

        return $vacancy;
    }


}
