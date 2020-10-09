<?php

namespace App\Libraries\Services;

use App\User;
use Auth;

use App\Libraries\Interfaces\UserAuthInterface;

class EloquentUserData implements UserAuthInterface{

    private $user;
    private $auth;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->auth = Auth::user();
    }

    //auth function start
    public function authId(){
        return $this->auth;
    }
    //auth function end




   //user model function start
    public function all(){
        return $this->user->get();
    }

    public function getCompany(){
        return $this->user->company_id;
    }

    public function getId(){
        return $this->user->id;
    }

    public function getRole(){
        return $this->user->role_id;
    }
     //user model function end
}
