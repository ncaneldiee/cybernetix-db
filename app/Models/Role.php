<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'app_role';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function account()
    {
        return $this->belongsToMany('App\Models\Account', 'app_role_account');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Models\Permission', 'app_permission_role');
    }

    public function attachPermission($name)
    {
        $this->permission()->attach($name);
    }

    public function detachPermission($name)
    {
        $this->permission()->detach($name);
    }

    public function hasPermission($name)
    {
        foreach ($this->permission as $permission) {
            if ($permission->name == $name) {
                return true;
            }
        }

        return false;
    }
}
