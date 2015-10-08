<?php

namespace App\Models\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'sysfo_group';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function member()
    {
        return $this->hasMany('App\Models\Sysfo\Member');
    }
}
