<?php

namespace Vibrary\Models;

require ROOTPATH . '/bootstrap.php';

use Illuminate\Database\Eloquent\Model as Eloquent;

class Video extends Eloquent
{

    protected $fillable = [
        'channelId', 'channelTitle', 'title', 'description', 'videoId', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
