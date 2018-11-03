<?php

namespace Vibrary\Models;

require ROOTPATH . '/bootstrap.php';

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Video
 * @package Vibrary\Models
 */
class Video extends Eloquent
{

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $fillable = [
        'channelId', 'channelTitle', 'title', 'description', 'videoId', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
