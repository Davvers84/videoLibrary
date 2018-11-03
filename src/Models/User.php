<?php

namespace Vibrary\Models;

require ROOTPATH . '/bootstrap.php';

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * @package Vibrary\Models
 */
class User extends Eloquent
{

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'remember_token'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
