<?php

namespace App\Cybernetix\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'sysfo_unit';

    public $timestamps = false;

    public function member()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Member', 'sysfo_unit_member');
    }
}
