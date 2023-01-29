<?php

namespace App\Repositories;

use App\Presenters\TopicPresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\TopicRepository;
use App\Models\Topic;

/**
 * Class TopicRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TopicRepositoryEloquent extends BaseRepositoryEloquent implements TopicRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return TopicPresenter::class;
    }
}
