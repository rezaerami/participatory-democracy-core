<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\UserRequests\UserProfileRequest;
use App\Http\Requests\UserRequests\UserTopicsRequest;
use App\Presenters\TopicPresenter;
use App\Presenters\UserPresenter;
use App\Services\TopicServices;
use App\Services\UserServices;

class UserController extends Controller
{
    protected $userServices, $topicServices;

    public function __construct(UserServices $userServices, TopicServices $topicServices)
    {
        $this->userServices = $userServices;
        $this->topicServices = $topicServices;
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

    public function topics(UserTopicsRequest $request)
    {
        try {
            $user = auth()->user();
            $topics = $this->topicServices->find(["user_id" => $user->id]);
            $topicsCount = count($topics);

            $topicPresenter = new TopicPresenter();
            $results = $topicPresenter->present($topics)["data"];
            $metadata = [
                "offset" => 0,
                "limit" => $topicsCount,
                "total" => $topicsCount,
            ];

            return Response::success($results, $metadata);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }


}
