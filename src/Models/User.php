<?php

namespace Vibrary\Models;

require ROOTPATH . '/bootstrap.php';

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{

    protected $fillable = [
        'name', 'email', 'password', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
