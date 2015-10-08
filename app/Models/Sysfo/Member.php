<?php

namespace App\Models\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'sysfo_member';

    protected $guarded = ['id'];

    protected $fillable = ['name'];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Models\Sysfo\Group');
    }

    public function unit()
    {
        return $this->belongsToMany('App\Models\Sysfo\Unit', 'sysfo_unit_member');
    }

    public function management()
    {
        return $this->belongsToMany('App\Models\Sysfo\Management', 'sysfo_management_log');
    }

    public function employee()
    {
        return $this->belongsToMany('App\Models\Sysfo\Employee', 'sysfo_management_log');
    }
}
