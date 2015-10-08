<?php

namespace App\Models\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table = 'sysfo_management';

    protected $guarded = ['id'];

    protected $fillable = ['name', 'tenure', 'vision', 'mission'];

    public $timestamps = false;

    public function employee()
    {
        return $this->belongsToMany('App\Models\Sysfo\Employee', 'sysfo_management_log');
    }

    public function member()
    {
        return $this->belongsToMany('App\Models\Sysfo\Member', 'sysfo_management_log');
    }
}
