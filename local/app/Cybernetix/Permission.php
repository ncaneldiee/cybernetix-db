<?php

namespace App\Cybernetix;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'app_permission';

    public $timestamps = false;

    public function role()
    {
        return $this->belongsToMany('App\Cybernetix\Role', 'app_permission_role');
    }
}
