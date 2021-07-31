<?php

namespace Modules\Applications\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\Applications\Models\Application;
use Modules\Properties\Models\Property;

class ApplicationRepository
{
    /**
     * @param $browse_inputs
     * @param $realtor
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function browse($browse_inputs, $realtor)
    {
        $query = Application::query()
            ->with(['vacancy'])
            ->where('applications.user_id', $realtor->id);

        if($application_status = Arr::get($browse_inputs,'application_status')){
            $query->where('applications.status',$application_status);
        }

        if($vacancy = Arr::get($browse_inputs,'vacancy')){
            $query->join('vacancies','applications.vacancy_id','=','vacancies.id')
                ->where('applications.vacancy_id',$vacancy);
        }


        $query->orderByDesc('applications.created_at');
        $properties = $query->paginate(15);

        return $properties;
    }


    /**
     * @param $data
     * @param $realtor
     * @return false|Application
     */
    function add($data, $realtor)
    {

        $application = new Application();
        $token =  Str::random(50);
        if($property_id = Arr::get($data,'property'))
        {
            if($property = Property::query()->where('id',$property_id)
                ->where('user_id',$realtor->id))
            {
                $application->property()->associate($property);
            }
            else{
                return false;
            }
        }
        $data['available_from'] = Carbon::parse(Arr::get($data,'available_from'));
        $data['token'] = $token;
        $data['link'] = url("/$realtor->id/".$token);
        $application->fill($data);
        $application->realtor()->associate($realtor);

        if ($application->save()) {
            return $application;
        } else {
            return false;
        }


    }

    /**
     * @param $data
     * @param $application
     * @return false
     */
    function editStatus($data, $application)
    {
        if($status = Arr::get($data,'status'))
        {
           $application->status = $status;
        }

        if ($application->save()) {
            return $application;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $realtor
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    function read($id, $realtor)
    {
        $application = Application::query()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->with(['vacancy','vacancy.property'])
            ->first();

        if ($application) {
            return $application;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $realtor
     * @return false|mixed
     */
    function delete($id, $realtor)
    {
        $result = Application::query()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->delete();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


    /**
     * @param $id
     * @param $realtor
     * @return bool
     */
    function restore($id, $realtor)
    {
        $result = Application::withTrashed()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->restore();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }




}
