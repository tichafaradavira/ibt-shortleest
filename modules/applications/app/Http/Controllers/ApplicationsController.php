<?php

namespace Modules\Applications\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Applications\Http\Requests\Application\DeleteApplicationRequest;
use Modules\Applications\Http\Requests\Application\ReadApplicationRequest;
use Modules\Applications\Http\Resources\Application;
use Modules\Applications\Http\Resources\ApplicationCollection;
use Modules\Applications\Services\ApplicationService;

class ApplicationsController extends Controller
{


    function browse(Request $request, ApplicationService $service)
    {

        $inputs = $request->all();

        $vacancies = $service->browse($inputs);
        return response(new ApplicationCollection($vacancies), 200);

    }


    function read(ReadApplicationRequest $request, ApplicationService $service, $entity)
    {
        $application = $service->read($entity);
        if ($application) {
            return response(new Application($application), 200);
        } else {
            return response('Cannot read Application', 422);
        }
    }

    function delete(DeleteApplicationRequest $request, ApplicationService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Application', 422);
        }
    }

    function restore(DeleteApplicationRequest $request, ApplicationService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Application', 422);
        }
    }



}
