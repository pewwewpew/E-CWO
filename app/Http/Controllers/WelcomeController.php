<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $companies = Company::All();
        $x = 0;
        return view('welcome',compact('companies','x'));
    }

    public function store()
    {
        return redirect(route('login'));
    }
}
