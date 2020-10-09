<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    //

    public function aircrafttype()
    {
        return $this->belongsToMany('App\AircraftType')->withPivot('manhours')->withTimestamps();
    }

    public function allget()
    {
        return $this->get();
    }

    public function allbyname($data)
    {
        return $data->pluck('name');
    }

    public function allbyid($data)
    {
        return $data->pluck('id');
    }

}
