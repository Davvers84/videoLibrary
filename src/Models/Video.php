<?php

namespace Vibrary\Models;

require ROOTPATH . '/bootstrap.php';

use Illuminate\Database\Eloquent\Model as Eloquent;

class Video extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channelId', 'channelTitle', 'title', 'description', 'videoId', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}