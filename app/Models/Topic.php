<?php

namespace App\Models;

use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

/**
 * Class Topic.
 *
 * @package namespace App\Models;
 */
class Topic extends BaseModel implements Presentable
{
    use PresentableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "slug",
        "title",
        "description",
        "content",
        "image",
        "user_id",
        "polis_description",
        "polis_comments",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
