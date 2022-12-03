<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository;
use App\Helpers\StringHelpers;
use App\Models\Base;
use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class BaseRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BaseRepositoryEloquent extends PrettusBaseRepository implements BaseRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Base::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function getByHashId($code)
    {
        return $this->find(StringHelpers::hashidToId($code));
    }
}
