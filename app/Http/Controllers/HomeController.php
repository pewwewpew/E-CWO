<?php

namespace App\Http\Controllers;

use App\Libraries\Services\HomeViewSelector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $view;

    public function redirectTo($request)
    {
        return route('/login');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index(HomeViewSelector $view)
    {
        $this->view = $view;

        $user = Auth::user();
        $role = $user->roles_id;
        return $this->view->select($role,$user);

    }

}
