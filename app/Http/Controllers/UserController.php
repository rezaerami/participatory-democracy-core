<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\UserRequests\UserProfileRequest;
use App\Presenters\UserPresenter;
use App\Services\UserServices;

class UserController extends Controller
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function profile(UserProfileRequest $request)
    {
        try {
            $user = auth()->user();
            $userPresenter = new UserPresenter();

            $results = $userPresenter->present($user)["data"];

            return Response::success($results);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }

    }
}
