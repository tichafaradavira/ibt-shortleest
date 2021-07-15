<?php

namespace Modules\Properties\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Applications\Models\Vacancy;
use Modules\Properties\Models\Client;
use Modules\Properties\Models\Property;

class PropertyRepository
{
    public static function browse($browse_inputs, $realtor)
    {
        $query = Property::query()
            ->where('user_id', $realtor->id)
            ->with(['client']);

        if($client = Arr::get($browse_inputs,'client'))
        {
            $query->where('client_id',$client);
        }

        $query->orderByDesc('created_at');
        $properties = $query->paginate(15);

        return $properties;
    }


    function add($data, $realtor)
    {
        $data['uuid'] = Str::uuid()->toString();
        $property = new Property();
        if ($client_id = Arr::get($data, 'client')) {
            if ($client = Client::find($client_id)) {
                $property->client()->associate($client);
            }
        }
        $property->fill($data);
        $property->realtor()->associate($realtor);

        if ($property->save()) {
            return $property;
        } else {
            return false;
        }


    }

    function edit($data, $property)
    {
        $property->fill($data);
        if ($property->save()) {
            return $property;
        } else {
            return false;
        }
    }

    function read($id, $realtor)
    {
        $property = Property::query()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->with(['client','vacancy'])
            ->first();

        if ($property) {
            return $property;
        } else {
            return false;
        }
    }

    function delete($id, $realtor)
    {
        $result = Property::query()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->delete();

        Vacancy::where('property_id', $id)->delete();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function restore($id, $realtor)
    {
        $result = Property::withTrashed()
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
