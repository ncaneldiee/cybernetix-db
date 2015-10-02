<?php

namespace App\Cybernetix;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'app_role';

    public $timestamps = false;

    public function account()
    {
        return $this->belongsToMany('App\Cybernetix\Account', 'app_role_user');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Cybernetix\Permission', 'app_permission_role');
    }
}
