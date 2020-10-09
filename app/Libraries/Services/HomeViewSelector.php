<?php

namespace App\Libraries\Services;

class HomeViewSelector{

    public function select($role,$user)
        {
            $user = $user;

            if($role == 'Costumer'){
                return view('costumers.home',compact('user'));
            }elseif($role == 'Admin'){
                return view('admin.home');
            }else{
                return view('performer.home');
            }
        }

}
