<?php

namespace App\Cybernetix\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'sysfo_employee';

    public $timestamps = false;

    public function member()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Member', 'sysfo_management_log');
    }

    public function management()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Management', 'sysfo_management_log');
    }

    public function children()
    {
       return $this->hasMany('App\Cybernetix\Sysfo\Employee');
    }

    public function children_recursive()
    {
       return $this->children()->with('children_recursive');
    }

    public function parent()
    {
       return $this->belongsTo('App\Cybernetix\Sysfo\Employee');
    }

    public function parent_recursive()
    {
       return $this->parent()->with('parent_recursive');
    }
}
