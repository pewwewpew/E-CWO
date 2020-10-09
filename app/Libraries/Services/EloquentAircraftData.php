<?php

namespace App\Libraries\Services;

use App\Aircraft;
use App\Libraries\Interfaces\AircraftDataInterface;


class EloquentAircraftData implements AircraftDataInterface{

    private $aircraft;
    public $number = 0;
    private $test;

    public function __construct(Aircraft $aircraft)
    {
        $this->aircraft = $aircraft;
    }

    public function all(){

        return $this->aircraft->get();

    }

    public function SortByCompaniesId($value)
    {
        $data = $this->aircraft->all()->where('company_id',$value);
        return $data;
    }

}
