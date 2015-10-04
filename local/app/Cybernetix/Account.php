<?php

namespace App\Cybernetix;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Account extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'app_account';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'confirm_token', 'remember_token'];

    public function role()
    {
        return $this->belongsToMany('App\Cybernetix\Role', 'app_role_user');
    }

    public function can($name)
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
