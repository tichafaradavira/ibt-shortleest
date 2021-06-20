<?php

namespace Modules\Applications\Services;


use Modules\Applications\Models\Vacancy;
use Modules\Applications\Repositories\VacancyRepository;

class VacancyService
{
    protected $repository;
    protected $realtor;

    function __construct(VacancyRepository $repository)
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
        $vacancy = $this->repository->add($inputs, $this->realtor);

        if ($vacancy) {
            return $vacancy;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $vacancy = Vacancy::query()
        ->where('user_id', $this->realtor->id)
        ->where('id',$id)
        ->first();

        if ($vacancy) {
            $vacancy = $this->repository->edit($inputs, $vacancy);
            return $vacancy;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $vacancy = $this->repository->read($id, $this->realtor);
            return $vacancy;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $vacancy = $this->repository->delete($id, $this->realtor);
            return $vacancy;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $vacancy = $this->repository->restore($id, $this->realtor);
            return $vacancy;
        } else {
            return false;
        }
    }

}
