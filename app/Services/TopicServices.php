<?php


namespace App\Services;


use App\Repositories\TopicRepositoryEloquent;

class TopicServices extends BaseService
{
    /**
     * @param TopicRepositoryEloquent $repository
     */
    public function __construct(TopicRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function all($offset, $limit)
    {
        return $this->repository->findWhere(["published" => true])
            ->skip($offset)
            ->take($limit);
    }

    public function count()
    {
        return $this->repository->findWhere(["published" => true])->count();
    }
}
