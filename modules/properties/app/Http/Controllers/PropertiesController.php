<?php

namespace Modules\Properties\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Properties\Http\Requests\Property\AddPropertyRequest;
use Modules\Properties\Http\Requests\Property\DeletePropertyRequest;
use Modules\Properties\Http\Requests\Property\EditPropertyRequest;
use Modules\Properties\Http\Requests\Property\ReadPropertyRequest;
use Modules\Properties\Http\Resources\Property;
use Modules\Properties\Http\Resources\PropertyCollection;
use Modules\Properties\Services\PropertyService;

class PropertiesController extends Controller
{


    function browse(Request $request, PropertyService $service)
    {

        $inputs = $request->all();

        $properties = $service->browse($inputs);
        return response(new PropertyCollection($properties), 200);

    }

    function add(AddPropertyRequest $request, PropertyService $service)
    {
        $inputs = $request->all();

        $property = $service->add($inputs);
        if ($property) {
            return response(new Property($property), 200);
        } else {
            return response('Property not added', 422);
        }
    }

    function edit(EditPropertyRequest $request, PropertyService $service, $entity)
    {
        $inputs = $request->all();

        $property = $service->edit($inputs, $entity);
        if ($property) {
            return response(new Property($property), 200);
        } else {
            return response('Property not edit', 422);
        }
    }


    function read(ReadPropertyRequest $request, PropertyService $service, $entity)
    {
        $property = $service->read($entity);
        if ($property) {
            return response(new Property($property), 200);
        } else {
            return response('Cannot read Property', 422);
        }
    }

    function delete(DeletePropertyRequest $request, PropertyService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Property', 422);
        }
    }

    function restore(DeletePropertyRequest $request, PropertyService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Property', 422);
        }
    }



}
