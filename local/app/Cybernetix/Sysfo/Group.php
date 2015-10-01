<?php

namespace App\Cybernetix\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'sysfo_group';

    public $timestamps = false;

    public function member()
    {
        return $this->hasMany('App\Cybernetix\Sysfo\Member');
    }
}
