<?php

namespace Modules\Properties\Services;

use Modules\Properties\Models\Client;
use Modules\Properties\Repositories\ClientRepository;

class ClientService
{
    protected $repository;
    protected $realtor;

    function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
        $this->realtor = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $properties = $this->repository->browse($inputs, $this->realtor);

        return $properties;
    }



    function labelList()
    {
        $clients = $this->repository->labelList($this->realtor);

        return $clients;
    }

    function add($inputs)
    {
        $client = $this->repository->add($inputs, $this->realtor);

        if ($client) {
            return $client;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $client = Client::query()
        ->where('user_id', $this->realtor->id)
        ->where('id',$id)
        ->first();

        if ($client) {
            $client = $this->repository->edit($inputs, $client);
            return $client;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $client = $this->repository->read($id, $this->realtor);
            return $client;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        if ($id) {
            $client = $this->repository->delete($id, $this->realtor);
            return $client;
        } else {
            return false;
        }
    }

    function restore($id)
    {
        if ($id) {
            $client = $this->repository->restore($id, $this->realtor);
            return $client;
        } else {
            return false;
        }
    }

}
