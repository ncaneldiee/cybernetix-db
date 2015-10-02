<?php

namespace App\Cybernetix\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'sysfo_member';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Cybernetix\Sysfo\Group');
    }

    public function unit()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Unit', 'sysfo_unit_member');
    }

    public function management()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Management', 'sysfo_management_log');
    }

    public function employee()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Employee', 'sysfo_management_log');
    }
}
