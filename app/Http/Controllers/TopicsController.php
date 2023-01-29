<?php

namespace App\Http\Controllers;

use App\Constants\FileConstants;
use App\Constants\RequestConstants;
use App\Helpers\Response;
use App\Helpers\StringHelpers;
use App\Http\Requests\TopicRequests\TopicCreateRequest;
use App\Http\Requests\TopicRequests\TopicDeleteRequest;
use App\Http\Requests\TopicRequests\TopicIndexRequest;
use App\Http\Requests\TopicRequests\TopicShowRequest;
use App\Http\Requests\TopicRequests\TopicUpdateRequest;
use App\Presenters\TopicPresenter;
use App\Services\FileServices;
use App\Services\TopicServices;
use Carbon\Carbon;

/**
 * Class TopicsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TopicsController extends Controller
{
    protected $topicServices;

    public function __construct(TopicServices $topicServices)
    {
        $this->topicServices = $topicServices;
    }

    public function index(TopicIndexRequest $request)
    {
        try {
            $offset = $request->input("offset", RequestConstants::DEFAULT_OFFSET);
            $limit = $request->input("limit", RequestConstants::MAX_LIMIT);

            $topics = $this->topicServices->getPublishedTopics($offset, $limit);
            $topicsCount = $this->topicServices->getPublishedTopicsCount();

            $topicPresenter = new TopicPresenter();
            $results = $topicPresenter->present($topics)["data"];
            $metadata = [
                "offset" => (integer)$offset,
                "limit" => (integer)$limit,
                "total" => (integer)$topicsCount < RequestConstants::MAX_OFFSET ? $topicsCount : RequestConstants::MAX_OFFSET,
            ];

            return Response::success($results, $metadata);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }

    public function create(TopicCreateRequest $request)
    {
        try {
            $user = auth()->user();

            $attributes = $request->except(["image", "polis_id", "polis_comments"]);

            $attributes["user_id"] = $user->id;
            $attributes["slug"] = StringHelpers::slugify(
                Carbon::now()->format("Y M D H i") . " " . $attributes["title"]
            );
            $attributes["image"] = FileServices::upload(
                $request->image,
                FileConstants::FILE_PATHS["TOPICS"]
            )["filename"];
            $attributes["polis_comments"] = json_encode($request->polis_comments);

            $topic = $this->topicServices->create($attributes);
            $results = $topic->presenter()["data"];

            return Response::success($results);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }

    public function show(TopicShowRequest $request, $topicCode)
    {
        try {
            $topic = $this->topicServices->show(StringHelpers::hashIdToId($topicCode));
            $results = $topic->presenter()["data"];

            return Response::success($results);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }

    public function update(TopicUpdateRequest $request, $topicCode)
    {
        try {
            $topic = $this->topicServices->show(StringHelpers::hashIdToId($topicCode));

            $attributes = [];

            $attributes["title"] = $request->input("title", $topic->title);
            $attributes["description"] = $request->input("description", $topic->description);
            $attributes["content"] = $request->input("content", $topic->content);

            if ($request->has("image")) {
                $attributes["image"] = FileServices::upload(
                    $request->image,
                    FileConstants::FILE_PATHS["TOPICS"]
                )["filename"];
            }

            $topic = $this->topicServices->update($attributes, $topic->id);
            $results = $topic->presenter()["data"];

            return Response::success($results);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }

    public function delete(TopicDeleteRequest $request, $topicCode)
    {
        try {
            $topic = $this->topicServices->delete(StringHelpers::hashIdToId($topicCode));
            $results = $topic->presenter()["data"];

            return Response::success($results);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }
}
