<?php

namespace App\Http\Controllers\Costumer;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlAircraftData;
use App\Libraries\Services\Sql\SqlDetailServiceData;
use App\Libraries\Services\Sql\SqlOrderData;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    //
    protected $aircraft;
    protected $order;
    protected $number;

    public function __construct(SqlAircraftData $aircraft,SqlOrderData $order)
    {
        $this->aircraft = $aircraft;
        $this->order = $order;
    }

    public function index(Request $request,SqlDetailServiceData $detailservice,$aircraft)
    {
        $urlaircraft = $aircraft;
        $urlcompany = Auth::user()->company_id;
        $checkInput = $this->aircraft->owned($urlcompany,$urlaircraft);
        //check jika data input dari url benar
        if($checkInput == false)
        {
            abort(404);
        }
        else
        $viewaircraft = $urlaircraft;

        //get aircraft type by its registration number
        $aircrafttype = $this->aircraft->getTypebyNumber($viewaircraft);

        //get order untuk aircraft registration dengan join table order dengan table aircraft_type_service
        $viewdata = $this->order->getTable('o')
        //start join
        ->join($detailservice->giveAlias('ats'),'o.aircraft_type_service_id','=','ats.id')//untuk dapat detail service
        ->join('users as u','u.id','=','o.userable_id')//untuk tau nama user
        ->join('services as s','s.id','=','ats.service_id')//untuk tau nama service
        ->get(['ats.*','o.*','o.id as id','o.created_at AS o_created_at','o.updated_at AS o_updated_at','ats.id AS ats_id','u.name AS user_name','u.company_id','s.name AS service_name'])//get the collection
        ->where('aircraft_id',$viewaircraft);
        //end join

        $page   =  $request->page?:1;
        $per_page = 1;
        $this->x =($page * $per_page) - $per_page;

        $paginatedviewdata = new LengthAwarePaginator(
            $viewdata->forPage($page, $per_page)->values(), // Only grab the items we need
            count($viewdata), // Total items
            $per_page, // Items per page
            $page, // Current page
            ['path' => 'orders'] // We need this so we can keep all old query parameters from the url
        );

        $totalpage = $paginatedviewdata->lastpage();//get total page

        return view('costumers.orders',['airtype' => $aircrafttype,'urlaircraft' => $viewaircraft,'viewdata' => $paginatedviewdata , 'x' => $this->x]);

    }

    public function update(Request $request)
    {

        //update approval order yang aktif
        $selectedorder = $this->order->getRecordbyId($request->id);
        $selectedorder->update([ "approval" => 1,"progress_id" => "progressing"]);
        return back();
    }

}
