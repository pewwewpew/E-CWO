<?php

namespace App\Http\Controllers\Addrecord;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlServiceData;

class AddServiceController extends Controller
{
    //
    private $service;

    public function __construct(SqlServiceData $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('costumers.addmenu.addservice');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->service->createNew($input['service']);

        return redirect('/add-data/service');

    }
}
