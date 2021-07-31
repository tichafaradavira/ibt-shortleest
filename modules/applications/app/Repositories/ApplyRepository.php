<?php

namespace Modules\Applications\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\Applications\Events\ApplicationSubmitted;
use Modules\Applications\Models\Application;
use Modules\Properties\Models\Property;

class ApplyRepository
{

    /**
     * @param $data
     * @param $vacancy
     * @return false|Application
     */
    function apply($data, $vacancy)
    {

        $application = new Application();
        $data['dob'] = Carbon::parse(Arr::get($data, 'dob'));
        $application->vacancy()->associate($vacancy);
        $application->realtor()->associate($vacancy->realtor);
        $application->property()->associate($vacancy->property);
        $application->fill($data);

        if ($application->save()) {
            ApplicationSubmitted::dispatch($application);

            return $application;
        } else {
            return false;
        }

    }

    /**
     * @param $email
     * @param $vacancy
     * @return bool
     */
    public function hasAppliedBefore($email,$vacancy){
        $property = Application::query()->where('email',$email)
            ->where('vacancy_id',$vacancy->id)
            ->first();

        if($property)
        {
            return true;
        }else{
            return false;
        }
    }
}
