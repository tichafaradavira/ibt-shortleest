<?php

namespace Modules\Applications\Services;


use Modules\Applications\Models\Application;
use Modules\Applications\Models\Vacancy;
use Modules\Applications\Repositories\ApplicationRepository;
use Modules\Applications\Repositories\ApplyRepository;

class ApplyService
{
    protected $repository;

    function __construct(ApplyRepository $repository)
    {
        $this->repository = $repository;
    }

    function add($inputs,$realtor,$token)
    {
        $vacancy = Vacancy::query()->where('user_id',$realtor->id)
            ->where('token',$token)
            ->first();

        $application = $this->repository->apply($inputs,$vacancy);

        if ($application) {
            return $application;
        } else {
            return false;
        }
    }


    function getVacancy($realtor,$token)
    {
        $vacancy = Vacancy::query()->where('user_id',$realtor->id)
            ->where('token',$token)
            ->where('status', 1)
            ->with('property')
            ->first();


        if ($vacancy) {
            return $vacancy;
        } else {
            return false;
        }


    }


}
