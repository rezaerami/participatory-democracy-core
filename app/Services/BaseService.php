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
     * @param $id
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function update($attributes, $id)
    {
        return $this->repository->update($attributes, $id);
    }

    /**
     * @param $id
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function show($id)
    {
        return $this->repository->find($id);
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
     * @param $id
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function delete($id)
    {
        $entity = $this->show($id);
        $this->repository->delete($id);

        return $entity;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->repository->count();
    }

    public function getByHashId($code)
    {
        return $this->repository->getByHashId($code);
    }
}
