<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlAircraftTypeData;
use App\Libraries\Services\Sql\SqlDetailServiceData;
use Illuminate\Http\Request;


class AdminDetailServiceViewController extends Controller
{
    //
    protected $detailservice;
    protected $number = 0;
    protected $airtype;


    public function __construct(SqlDetailServiceData $detailservice)
    {
        $this->detailservice = $detailservice;
    }

    public function index(SqlAircraftTypeData $airtype,Request $request)
    {
        $collection = $airtype->getAll();
        $x =$this->number;
        $airtypeid = $airtype->getId($collection);
        //getTable() itu DB::table('aircraft_type_service AS ats')
        $viewdata = $this->detailservice->getTable('ats')
        //start join
        ->join('services AS s','s.id','=','ats.service_id')->get(['s.created_at AS screate','s.*','ats.*']);
        //end join

        //start ajax
        if($request->ajax()){
            $airtype = $request->airtype;
            $selected = $viewdata->where('aircraft_type_id',$airtype);
            return view('dynamicview.detailservice')->with([
                'detailservices' => $selected,
                'x' => $x,
            ])->render();
        }//end ajax

        $selected = [];
        return view('admin.detailservices',
            [
                //passing variable ke view (' view attribute ' => $controller attribute)
                'detailservices' => $selected,
                'x' => $x,
                'airtypeid' => $airtypeid,
            ]);
    }
}
