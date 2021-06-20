<?php

namespace Modules\Applications\Services;


use Modules\Applications\Models\Application;
use Modules\Applications\Repositories\ApplicationRepository;

class ApplicationService
{
    protected $repository;
    protected $realtor;

    function __construct(ApplicationRepository $repository)
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

        $application = $this->repository->add($inputs, $this->realtor);

        if ($application) {
            return $application;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $application = Application::query()
        ->where('user_id', $this->realtor->id)
        ->where('id',$id)
        ->first();

        if ($application) {
            $application = $this->repository->edit($inputs, $application);
            return $application;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $application = $this->repository->read($id, $this->realtor);
            return $application;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $application = $this->repository->delete($id, $this->realtor);
            return $application;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $application = $this->repository->restore($id, $this->realtor);
            return $application;
        } else {
            return false;
        }
    }

}
