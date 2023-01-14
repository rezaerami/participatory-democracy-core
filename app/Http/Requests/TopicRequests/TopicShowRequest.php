<?php

namespace App\Http\Requests\TopicRequests;

use App\Constants\HttpStatus;
use App\Helpers\Response;
use App\Http\Requests\BaseRequest;
use App\Services\TopicServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TopicShowRequest extends BaseRequest
{
    protected $topicServices;

    public function __construct(TopicServices $topicServices)
    {
        parent::__construct();

        $this->topicServices = $topicServices;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $topic = $this->topicServices->getByHashId($this->topicCode);

            return $this->user()->can("view", $topic);
        } catch (ModelNotFoundException $e) {
            throw Response::error(HttpStatus::NOT_FOUND, HttpStatus::TITLE[HttpStatus::NOT_FOUND]);
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
