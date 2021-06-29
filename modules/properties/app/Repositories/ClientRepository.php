<?php

namespace Modules\Properties\Repositories;

use Illuminate\Support\Arr;
use Modules\Properties\Models\Client;

class ClientRepository
{
    public static function browse($browse_inputs, $realtor)
    {
        $query = Client::query()
            ->where('user_id', $realtor->id);

        $query->orderByDesc('created_at');
        $properties = $query->paginate(15);

        return $properties;
    }


    public static function labelList($realtor)
    {
        $query = Client::query()
            ->select('id','full_name')
            ->where('user_id', $realtor->id);


        $clients = $query->get();

        return $clients;
    }


    function add($data, $realtor)
    {

        $client = new Client();
        $client->fill($data);
        $client->realtor()->associate($realtor);

        if ($client->save()) {
            return $client;
        } else {
            return false;
        }


    }

    function edit($data, $client)
    {
        $client->fill($data);
        if ($client->save()) {
            return $client;
        } else {
            return false;
        }
    }

    function read($id, $realtor)
    {
        $client = Client::query()
            ->where('id', $id)
            ->where('user_id', $realtor->id)
            ->first();

        if ($client) {
            return $client;
        } else {
            return false;
        }
    }

    function delete($id, $realtor)
    {
        $result = Client::query()
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
        $result = Client::withTrashed()
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
