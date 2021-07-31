<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\User\DeleteUserRequest;
use Modules\Admin\Http\Requests\User\ReadUserRequest;
use Modules\Admin\Http\Resources\User;
use Modules\Admin\Http\Resources\UserCollection;
use Modules\Admin\Services\UsersService;
use Modules\Users\Http\Requests\Realtor\LoginRequest;
use Modules\Users\Http\Resources\User as UserResource;
use Modules\Users\Services\UserService;

class UsersController extends Controller
{
    protected function signIn(LoginRequest $request, UserService $service)
    {
        $inputs = $request->all();
        $user = $service->getUserByEmail($inputs['email']);

        if ($user && $user->is_admin) {

            if (Hash::check($inputs['password'], $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                return response(['user' => new UserResource($user), 'token' => $token], 200);
            } else {
                return response("Invalid credentials", 401);
            }
        } else {
            return response('Invalid credentials', 401);
        }
    }

    /**
     * @param Request $request
     * @param UsersService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */

    function browse(Request $request, UsersService $service)
    {

        $inputs = $request->all();

        $admin = $service->browse($inputs);
        return response(new UserCollection($admin), 200);

    }

    /**
     * @param ReadUserRequest $request
     * @param UsersService $service
     * @param $entity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function read(ReadUserRequest $request, UsersService $service, $entity)
    {
        $user = $service->read($entity);
        if ($user) {
            return response(new User($user), 200);
        } else {
            return response('Cannot read User', 422);
        }
    }

    /**
     * @param DeleteUserRequest $request
     * @param UsersService $service
     * @param $entity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function suspend(Request $request, UsersService $service, $entity)
    {
        $result = $service->suspend($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot suspend User', 422);
        }
    }

    function activate(Request $request, UsersService $service, $entity)
    {
        $result = $service->activate($entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot activate User', 422);
        }
    }



}
