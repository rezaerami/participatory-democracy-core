<?php

namespace App\Policies;

use App\Constants\HttpStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BasePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * @return Response
     */
    public function resolve()
    {
        return Response::allow();
    }

    /**
     * @param $statusCode
     */
    public function reject($statusCode)
    {
        throw new \Exception(HttpStatus::TITLE[$statusCode], $statusCode);
    }


    public function viewAll(User $user)
    {
        return $this->resolve();
    }

    public function view(User $user, $model)
    {
        return $this->resolve();
    }

    public function create(User $user)
    {
        return $this->resolve();
    }

    public function update(User $user, $model)
    {
        if((int) $user->id === (int) $model->user_id)
            return $this->resolve();

        $this->reject(HttpStatus::FORBIDDEN);
    }

    public function delete(User $user, $model)
    {
        if((int) $user->id === (int) $model->user_id)
            return $this->resolve();

        $this->reject(HttpStatus::FORBIDDEN);
    }
}
