<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $guarded = [];

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany('App\User','company_id');
    }

    public function aircrafts()
    {
        return $this->hasMany('App\Aircraft','company_id');
    }

}


