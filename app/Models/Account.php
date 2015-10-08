<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Account extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, SoftDeletes, CanResetPassword;

    protected $table = 'app_account';

    protected $guarded = ['id'];

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'confirm_token', 'remember_token'];

    protected $dates = ['deleted_at'];

    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'app_role_account');
    }

    public function can($name, array $arg = [])
    {
        foreach ($this->role as $role) {
            foreach ($role->permission as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    public function attachRole($name)
    {
        $this->role()->attach($name);
    }

    public function detachRole($name)
    {
        $this->role()->detach($name);
    }

    public function hasRole($name)
    {
        foreach($this->role as $role) {
            if ($role->name == $name) {
                return true;
            }
        }

        return false;
    }
}
