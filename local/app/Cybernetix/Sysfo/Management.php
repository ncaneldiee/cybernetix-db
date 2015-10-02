<?php

namespace App\Cybernetix\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table = 'sysfo_management';

    protected $fillable = ['name', 'tenure', 'vision', 'mission'];

    public $timestamps = false;

    public function employee()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Employee', 'sysfo_management_log');
    }

    public function member()
    {
        return $this->belongsToMany('App\Cybernetix\Sysfo\Member', 'sysfo_management_log');
    }
}
