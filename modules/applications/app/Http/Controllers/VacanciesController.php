<?php

namespace Modules\Applications\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Modules\Applications\Http\Requests\Vacancy\AddVacancyRequest;
use Modules\Applications\Http\Requests\Vacancy\DeleteVacancyRequest;
use Modules\Applications\Http\Requests\Vacancy\EditVacancyRequest;
use Modules\Applications\Http\Requests\Vacancy\ReadVacancyRequest;
use Modules\Applications\Http\Resources\Vacancy;
use Modules\Applications\Http\Resources\VacancyCollection;
use Modules\Applications\Repositories\VacancyRepository;
use Modules\Applications\Services\VacancyService;
use Modules\Properties\Models\Property;

class VacanciesController extends Controller
{


    function browse(Request $request, VacancyService $service)
    {

        $inputs = $request->all();

        $vacancies = $service->browse($inputs);
        return response(new VacancyCollection($vacancies), 200);

    }

    function add(AddVacancyRequest $request, VacancyService $service, VacancyRepository $repository)
    {
        $inputs = $request->all();

        if($property_id = Arr::get($inputs,'property')){
            $property = $repository->getVacancyProperty($property_id,auth()->guard('api')->user());

            if($property){
                return response('Vacancy not created.There is already a vacancy for selected property(either pending or active).', 401);

            }

        }

        $vacancy = $service->add($inputs);
        if ($vacancy) {
            return response(new Vacancy($vacancy), 200);
        } else {
            return response('Vacancy not added', 422);
        }
    }

    function edit(EditVacancyRequest $request, VacancyService $service, $entity)
    {
        $inputs = $request->all();

        $vacancy = $service->edit($inputs, $entity);
        if ($vacancy) {
            return response(new Vacancy($vacancy), 200);
        } else {
            return response('Vacancy not edit', 422);
        }
    }


    function read(ReadVacancyRequest $request, VacancyService $service, $entity)
    {
        $vacancy = $service->read($entity);
        if ($vacancy) {
            return response(new Vacancy($vacancy), 200);
        } else {
            return response('Cannot read Vacancy', 422);
        }
    }

    function delete(DeleteVacancyRequest $request, VacancyService $service, $entity)
    {
        $result = $service->delete($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete Vacancy', 422);
        }
    }

    function restore(DeleteVacancyRequest $request, VacancyService $service, $entity)
    {
        $result = $service->restore($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot restore Vacancy', 422);
        }
    }



}
