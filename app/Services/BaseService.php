<?php


namespace App\Services;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class BaseService
{
    protected $repository;

    /**
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function all($offset, $limit)
    {
        return $this->repository->offset($offset)->limit($limit)->get();
    }

    /**
     * @param $attributes
     */
    public function create($attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * @param $attributes
     * @param $userId
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function update($attributes, $userId)
    {
        return $this->repository->update($attributes, $userId);
    }

    /**
     * @param $userId
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function show($userId)
    {
        return $this->repository->find($userId);
    }

    /**
     * @param $attributes
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function find($attributes)
    {
        return $this->repository->findWhere($attributes);
    }

    /**
     * @param $userId
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function delete($userId)
    {
        $user = $this->show($userId);
        $this->repository->delete($userId);

        return $user;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->repository->count();
    }
}
