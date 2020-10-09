<?php

namespace App\Libraries\Interfaces;

interface AircraftDataInterface{

//method untuk ambil data collection
public function all();

//method untuk ambil data berdasarkan value dari attribute companyid
public function SortByCompaniesId($companyidvalue);

};
