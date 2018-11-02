<?php

namespace Vibrary\Models;

require ROOTPATH . '/bootstrap.php';

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    public function videos()
//    {
//        return $this->hasMany('Videos');
//    }


}
