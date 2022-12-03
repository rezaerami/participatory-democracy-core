<?php

namespace App\Http\Controllers;

use App\Constants\FrontendConstants;
use App\Helpers\Response;
use App\Http\Requests\AuthRequests\AuthSsoCallbackRequest;
use App\Http\Requests\AuthRequests\AuthSsoRedirectRequest;
use App\Services\UserServices;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function ssoRedirect(AuthSsoRedirectRequest $request, $service)
    {
        try {
            return Socialite::driver($service)->stateless()->redirect();
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }

    public function ssoCallback(AuthSsoCallbackRequest $request, $service)
    {
        try {
            $user = Socialite::driver($service)->stateless()->user();

            if ($foundUser = $this->userServices->find(["email" => $user->email])->first()) {
                $user = $foundUser;
            } else {
                $attributes = [
                    "name" => $user->name,
                    "username" => $user->email,
                    "email" => $user->email,
                    "email_verified_at" => Carbon::now(),
                    "last_login" => Carbon::now(),
                ];
                $user = $this->userServices->create($attributes);
            }

            $token = JWTAuth::fromUser($user);
            return redirect(env("FRONTEND_URL") . strtr(FrontendConstants::URLS["SSO"], [
                    "{token}" => $token,
                ]));

        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }

}
