<?php

namespace Modules\Applications\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Modules\Applications\Http\Requests\Application\AddApplicationRequest;
use Modules\Applications\Http\Requests\Application\ReadApplicationRequest;
use Modules\Applications\Http\Resources\Application;
use Modules\Applications\Http\Resources\Vacancy;
use Modules\Applications\Repositories\ApplyRepository;
use Modules\Applications\Services\ApplyService;
use Modules\Users\Models\User;

class ApplyController extends Controller
{
    /**
     * @param AddApplicationRequest $request
     * @param ApplyService $service
     * @param ApplyRepository $repository
     * @param User $realtor
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function apply(AddApplicationRequest $request, ApplyService $service, ApplyRepository $repository, User $realtor, $token)
    {
        $inputs = $request->all();

        $vacancy = \Modules\Applications\Models\Vacancy::query()->where('user_id', $realtor->id)
            ->where('token', $token)
            ->first();

        $result = $repository->hasAppliedBefore(Arr::get($inputs, 'email'), $vacancy);
        if ($result) {
            return response('You have already applied for this vacancy', 422);
        }

        $application = $service->add($inputs, $vacancy);
        if ($application) {
            return response(new Application($application), 200);
        } else {
            return response('Application not added', 422);
        }
    }

    /**
     * @param ReadApplicationRequest $request
     * @param ApplyService $service
     * @param User $realtor
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function getVacancy(ReadApplicationRequest $request, ApplyService $service, User $realtor, $token)
    {

        $vacancy = $service->getVacancy($realtor, $token);
        if ($vacancy) {
            return response(new Vacancy($vacancy), 200);
        } else {
            return response('Vacancy no longer active', 422);
        }
    }


}
