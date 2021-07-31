<?php

namespace Modules\Users\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\Realtor\EditRealtorRequest;
use Modules\Users\Http\Requests\Realtor\ForgotPasswordRequest;
use Modules\Users\Http\Requests\Realtor\LoginRequest;
use Modules\Users\Http\Requests\Realtor\ResetPasswordRequest;
use Modules\Users\Http\Requests\Realtor\UserSignUpRequest;
use Modules\Users\Http\Requests\Realtor\VerifyEmailRequest;
use Modules\Users\Models\User;
use Modules\Users\Services\UserService;
use Modules\Users\Http\Resources\User as UserResource;

class UserController extends Controller
{
    protected function signUp(UserSignUpRequest $request, UserService $service)
    {

        $inputs = $request->all();
        $user = User::where('email', $inputs['email'])->first();

        if (!$user) {
            $user = $service->signup($inputs);
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;

            return response('Verify your email', 200);

        } else {
            return response('Email already in use', 401);

        }

    }

    protected function signIn(LoginRequest $request, UserService $service)
    {
        $inputs = $request->all();
        $user = $service->getUserByEmail($inputs['email']);

        if ($user) {
            if ($user->suspended_at != null) {
                return response("Account suspended", 503);
            }

            if ($user->email_verified_at == null) {
                return response("Please verify your email", 401);
            }

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



    public function verifyEmail(VerifyEmailRequest $request, UserService $service)
    {
        $inputs = $request->all();
        $user = $service->verifyEmail($inputs);
        if ($user) {
            return response('Email verified', 200);
        } else {
            return response('Invalid password', 401);

        }
    }



    public function resetPassword(ResetPasswordRequest $request, UserService $service)
    {
        $inputs = $request->all();

        $user = $service->resetPassword($inputs);
        if ($user) {
            return response('Password reset, you can login', 200);
        } else {
            return response('Invalid One Time Pin', 422);

        }
    }

    public function forgotPassword(ForgotPasswordRequest $request, UserService $service)
    {
        $email = $request->input('email');
        $user = $service->getUserByEmail($email);
        if(!$user){
            return response('User with provided email address not found', 401);
        }

        $result = $service->forgotPassword($user);
        if ($result) {
            return response('Password reset email sent', 401);
        } else {
            return response('Invalid One Time Pin', 401);

        }
    }


    protected function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response('Logged Out', 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    protected function profile(Request $request)
    {
        $user = $request->user();

        return response(new UserResource($user), 200);
    }

    protected function deactivate(Request $request, UserService $service)
    {
        $user = $request->user();

        $user = $service->deactivate($user);
        $user->token()->revoke();

        if($user){
            return response('Account deactivated!',  200);

        }else{
            return response( "Account not deactivated", 422);

        }
    }


    /**
     * @param EditRealtorRequest $request
     * @param UserService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    protected function editProfile(EditRealtorRequest $request, UserService $service)
    {
        $user = $request->user();
        $inputs = $request->all();
        $user =  $service->updateProfile($inputs, $user);

         if($user){
             return response(new UserResource($user), 200);

         }else{
             return response(new UserResource($user), 422);

         }
    }


}
