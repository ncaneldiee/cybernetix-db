<?php

namespace App\Models\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'sysfo_employee';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function member()
    {
        return $this->belongsToMany('App\Models\Sysfo\Member', 'sysfo_management_log');
    }

    public function management()
    {
        return $this->belongsToMany('App\Models\Sysfo\Management', 'sysfo_management_log');
    }

    public function children()
    {
       return $this->hasMany('App\Models\Sysfo\Employee');
    }

    public function children_recursive()
    {
       return $this->children()->with('children_recursive');
    }

    public function parent()
    {
       return $this->belongsTo('App\Models\Sysfo\Employee');
    }

    public function parent_recursive()
    {
       return $this->parent()->with('parent_recursive');
    }
}
