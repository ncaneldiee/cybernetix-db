<?php

namespace App\Models\Sysfo;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'sysfo_unit';

    protected $guarded = ['id'];

    protected $fillable = ['name'];

    public $timestamps = false;

    public function member()
    {
        return $this->belongsToMany('App\Models\Sysfo\Member', 'sysfo_unit_member');
    }
}
