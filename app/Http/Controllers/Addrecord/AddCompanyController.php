<?php

namespace App\Http\Controllers\Addrecord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlCompanyData;

class AddCompanyController extends Controller
{
    //
    private $company;

    public function __construct(SqlCompanyData $company)
    {
        $this->company = $company;
    }

    public function index()
    {
        return view('costumers.addmenu.addcompany');
    }

    public function store(Request $request)
    {
        //take request data
        $company = $request->company;

        //add new record into company table
        $this->company->createNew($company);

        return redirect('/add-data/company');
    }
}
