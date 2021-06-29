<?php

namespace Modules\Applications\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\Applications\Models\Vacancy;
use Modules\Properties\Models\Property;

class VacancyRepository
{
    public static function browse($browse_inputs, $realtor)
    {
        $query = Vacancy::query()
            ->with(['property'])
            ->where('user_id', $realtor->id);

        $query->orderByDesc('created_at');
        $properties = $query->paginate(15);

        return $properties;
    }


    function add($data, $realtor)
    {

        $vacancy = new Vacancy();
        $token =  Str::random(50);
        if($property_id = Arr::get($data,'property'))
        {
            if($property = Property::query()->where('id',$property_id)
                ->where('user_id',$realtor->id)->first())
            {
                $vacancy->property()->associate($property);
            }
            else{
                return false;
            }
        }

        $data['available_from'] = Carbon::parse(Arr::get($data,'available_from'));
        $data['token'] = $token;
        $data['link'] = url("/#/apply/$realtor->id/".$token);
        $vacancy->fill($data);
        $vacancy->realtor()->associate($realtor);


        if ($vacancy->save()) {
            return $vacancy;
        } else {
            return false;
        }


    }

    function edit($data, $vacancy)
    {
        $vacancy->fill($data);
        if ($vacancy->save()) {
            return $vacancy;
        } else {
            return false;
        }
    }

    function read($id, $realtor)
    {
        $vacancy = Vacancy::query()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->with(['property'])
            ->first();

        if ($vacancy) {
            return $vacancy;
        } else {
            return false;
        }
    }

    function delete($id, $realtor)
    {
        $result = Vacancy::query()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->delete();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function restore($id, $realtor)
    {
        $result = Vacancy::withTrashed()
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
