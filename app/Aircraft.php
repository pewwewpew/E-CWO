<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    //
    protected $guarded = [];

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function users()
    {
        return $this->belongsToMany('App\User','aircraft_user');
    }


}

