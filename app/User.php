<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','company_id','roles_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //relationship method

    public function orders()
    {
        return $this->morphMany('App\Order','userable');
    }

    public function aircrafts()
    {
        return $this->belongsToMany('App\Aircraft','aircraft_user');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }


    //custom method

    public function getRoles()
    {
        return $this->roles_id;
    }

    public function extend()
    {
        if($this->getRoles() == 'Admin')
        {
            return 'admin';
        }
        elseif($this->getRoles() == 'Costumer')
        {
            return '';
        }
        else
        {
            return 'performer';
        }
    }
}

