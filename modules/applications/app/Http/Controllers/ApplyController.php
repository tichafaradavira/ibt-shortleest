<?php

namespace Modules\Applications\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Applications\Http\Requests\Application\AddApplicationRequest;
use Modules\Applications\Http\Requests\Application\ReadApplicationRequest;
use Modules\Applications\Http\Resources\Application;
use Modules\Applications\Http\Resources\Vacancy;
use Modules\Applications\Services\ApplyService;
use Modules\Users\Models\User;

class ApplyController extends Controller
{
    function apply(AddApplicationRequest $request, ApplyService $service,User  $realtor,$token)
    {
        $inputs = $request->all();

        $application = $service->add($inputs,$realtor,$token);
        if ($application) {
            return response(new Application($application), 200);
        } else {
            return response('Application not added', 422);
        }
    }

    function getVacancy(ReadApplicationRequest $request, ApplyService $service,User  $realtor,$token)
    {

        $vacancy = $service->getVacancy($realtor,$token);
        if ($vacancy) {
            return response(new Vacancy($vacancy), 200);
        } else {
            return response('Vacancy no longer active', 422);
        }
    }



}
