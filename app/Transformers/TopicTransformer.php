<?php

namespace App\Transformers;

use App\Constants\FileConstants;
use App\Helpers\StringHelpers;
use App\Presenters\UserPresenter;
use League\Fractal\TransformerAbstract;
use App\Models\Topic;

/**
 * Class TopicTransformer.
 *
 * @package namespace App\Transformers;
 */
class TopicTransformer extends TransformerAbstract
{
    protected $userPresenter;

    public function __construct()
    {
        $this->userPresenter = new UserPresenter();
    }

    /**
     * Transform the Topic entity.
     *
     * @param \App\Models\Topic $model
     *
     * @return array
     */
    public function transform(Topic $model)
    {
        return [
            'code'              => (string) StringHelpers::idToHashId($model->id),

            /* place your other model properties here */

            'slug'              => (string) $model->slug,
            'title'             => (string) $model->title,
            'description'       => (string) $model->description,
            'content'           => (string) $model->content,
            'polisId'           => (string) $model->polis_id,
            'polisSiteId'       => (string) $model->polis_site_id,
            'image'             => (string) $model->image ? asset("/storage".FileConstants::FILE_PATHS["TOPICS"].$model->image) : null,
            'published'         => (boolean) $model->published,
            'user'              => $this->userPresenter->present($model->user)["data"],

            'createdAt'         => (string) $model->created_at,
            'updatedAt'         => (string) $model->updated_at,
        ];
    }
}
