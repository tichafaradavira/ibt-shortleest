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

            return response('VERIFY_EMAIL', 200);

        } else {
            return response('EMAIL_TAKEN', 401);

        }

    }

    protected function signIn(LoginRequest $request, UserService $service)
    {
        $inputs = $request->all();
        $user = $service->getUserByEmail($inputs['email']);

        if ($user) {
            if ($user->suspended_at != null) {
                return response("ACCOUNT_SUSPENDED", 503);
            }

            if ($user->email_verified_at == null) {
                return response("VERIFY_EMAIL", 200);
            }

            if (Hash::check($inputs['password'], $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                return response(['user' => new UserResource($user), 'token' => $token], 200);
            } else {
                return response("INVALID_CREDENTIALS", 401);
            }
        } else {
            return response('INVALID_CREDENTIALS', 401);
        }
    }



    public function verifyEmail(VerifyEmailRequest $request, UserService $service)
    {
        $inputs = $request->all();
        $user = $service->verifyEmail($inputs);
        if ($user) {
            return response('EMAIL_VERIFIED', 200);
        } else {
            return response('INVALID_PASSWORD', 401);

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
            return response('PASSWORD_RESET_EMAIL_SEND', 200);
        } else {
            return response('Invalid One Time Pin', 200);

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
