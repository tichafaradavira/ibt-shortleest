<?php

namespace Modules\Properties\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Properties\Http\Requests\Client\AddClientRequest;
use Modules\Properties\Http\Requests\Client\DeleteClientRequest;
use Modules\Properties\Http\Requests\Client\EditClientRequest;
use Modules\Properties\Http\Requests\Client\ReadClientRequest;
use Modules\Properties\Http\Resources\Client;
use Modules\Properties\Http\Resources\ClientCollection;
use Modules\Properties\Services\ClientService;

class ClientsController extends Controller
{


    function browse(Request $request, ClientService $service)
    {

        $inputs = $request->all();

        $properties = $service->browse($inputs);
        return response(new ClientCollection($properties), 200);

    }

    function add(AddClientRequest $request, ClientService $service)
    {
        $inputs = $request->all();

        $client = $service->add($inputs);
        if ($client) {
            return response(new Client($client), 200);
        } else {
            return response('Client not added', 422);
        }
    }

    function edit(EditClientRequest $request, ClientService $service, $entity)
    {
        $inputs = $request->all();

        $client = $service->edit($inputs, $entity);
        if ($client) {
            return response(new Client($client), 200);
        } else {
            return response('Client not edit', 422);
        }
    }


    function read(ReadClientRequest $request, ClientService $service, $entity)
    {
        $client = $service->read($entity);
        if ($client) {
            return response(new Client($client), 200);
        } else {
            return response('Cannot read Client', 422);
        }
    }

    function delete(DeleteClientRequest $request, ClientService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Client', 422);
        }
    }

    function restore(DeleteClientRequest $request, ClientService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Client', 422);
        }
    }


    function labelList(Request $request, ClientService $service)
    {
        $clients = $service->labelList();
        if ($clients) {
            return response($clients, 200);
        } else {
            return response('Clients not found', 422);
        }
    }


}
