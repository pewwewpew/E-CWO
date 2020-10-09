<?php

namespace App\Http\Controllers\Addrecord;


use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlAircraftTypeData;
use App\Libraries\Services\Sql\SqlDetailServiceData;
use App\Libraries\Services\Sql\SqlServiceData;
use Illuminate\Http\Request;

class AddDetailServiceController extends Controller
{
    //
    protected $service;
    protected $airtype;

    public function __construct(SqlServiceData $service,SqlAircraftTypeData $airtype)
    {
        $this->service = $service;
        $this->airtype = $airtype;
    }

    public function index()
    {
        $airtype = $this->airtype->getAll();
        $service = $this->service->getAll();
        return view('costumers.addmenu.adddetailservice',compact('airtype','service'));
    }

    public function store(Request $request,SqlDetailServiceData $detailservice)
    {
        $service_name = request('service');
        $airtype = request('type');
        $manhours = request('manhours');
        $servicecollection = $this->service->getAll()->where('name',$service_name);
        $serviceid = $this->service->getIdVal($servicecollection);
        $detailservice->createNew($serviceid,$airtype,$manhours);

        return redirect('/add-data/detail-service');

    }
}
