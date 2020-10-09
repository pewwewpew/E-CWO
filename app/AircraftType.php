<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftType extends Model
{
    //
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function aircraft()
    {
        return $this->hasMany('App\Aircraft','aircraft_types_id');
    }

    public function service()
    {
        return $this->belongsToMany('App\Service');
    }

    public function getType($string)
    {
        return $this->where('id',$string)->first();
    }

}
