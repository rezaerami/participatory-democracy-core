<?php

namespace App\Observers;

class BaseObserver
{
    protected $user;

    /**
     * BaseObserver constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }
    /**
     * @param $model
     */
    public function creating($model)
    {
        if($this->user) {
            $model->created_by = $this->user->id;
            $model->updated_by = $this->user->id;
        }
    }

    /**
     * @param $model
     */
    public function updating($model)
    {
        if($this->user) {
            $model->updated_by = $this->user->id;
        }
    }

    /**
     * @param $model
     */
    public function deleted($model)
    {
        if($this->user) {
            $model->deleted_by = $this->user->id;
            $model->save();
        }
    }
}
