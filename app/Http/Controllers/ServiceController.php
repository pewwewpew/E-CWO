<?php

namespace App\Http\Controllers;

use App\Libraries\Services\Sql\SqlServiceData;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    private $service;
    private $x = 0;

    public function __construct(SqlServiceData $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $x = $this->x;
        $service = $this->service;
        $allservicename = $service->getAll();

        return view('admin.services',['services' => $allservicename , 'x' => $x]);
    }

    public function destroy($id)
    {
        $service = $this->service->getTable(NULL)->where('id',$id)->delete();
        return redirect('/services');
    }
}
