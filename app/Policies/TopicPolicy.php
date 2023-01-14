<?php

namespace App\Policies;

use App\Constants\HttpStatus;
use App\Models\User;

class TopicPolicy extends BasePolicy
{
    public function view(User $user, $model)
    {
        if ($model->published || (int)$user->id === (int)$model->user_id)
            return $this->resolve();

        $this->reject(HttpStatus::FORBIDDEN);
    }
}
