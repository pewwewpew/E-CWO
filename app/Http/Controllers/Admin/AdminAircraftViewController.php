<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Interfaces\AircraftDataInterface;
use App\Libraries\Interfaces\UserAuthInterface;
use Illuminate\Http\Request;


class AdminAircraftViewController extends Controller
{
    //
    protected $eloquentaircraftdata;
    protected $aircraft;

    public function __construct(AircraftDataInterface $eloquentaircraftdata)
    {
        $this->middleware('is.admin');
        $this->eloquentaircraftdata = $eloquentaircraftdata;
        $this->aircraft = $this->eloquentaircraftdata->SortByCompaniesId('Citilink');

    }

    public function index()
    {

        $viewdata = $this->eloquentaircraftdata->all();
        $x =$this->eloquentaircraftdata->number;
        return view('admin.aircraft',
            [
                //passing variable ke view (' view attribute ' => $controller attribute)
                'viewdata' => $viewdata,
                'x' => $x,
            ]);
    }
}
