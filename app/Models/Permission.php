<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'app_permission';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'app_permission_role');
    }
}
