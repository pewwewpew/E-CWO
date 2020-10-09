<?php

namespace App\Libraries\Interfaces;


interface UserAuthInterface{


    public function all();
    public function getCompany();
    public function getId();
    public function getRole();

}
