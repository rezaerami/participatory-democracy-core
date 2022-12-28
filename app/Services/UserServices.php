<?php


namespace App\Services;


use App\Repositories\UserRepositoryEloquent;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class UserServices extends BaseService
{
    /**
     * @param UserRepositoryEloquent $repository
     */
    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $userId
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function updateLoginStatus($userId)
    {
        return $this->update([ 'last_login' => Carbon::now()], $userId);
    }
}
