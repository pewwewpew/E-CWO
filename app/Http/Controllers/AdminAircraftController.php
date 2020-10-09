<?php

namespace App\Http\Controllers;

use App\Libraries\Services\Sql\SqlCompanyData;
use App\Libraries\Services\Sql\SqlAircraftData;
use App\Libraries\Services\Sql\SqlDetailServiceData;
use App\Libraries\Services\Sql\SqlOrderData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;

class AdminAircraftController extends Controller
{
    //
    private $company;
    private $user;
    private $aircraft;
    private $x = 0;

    public function __construct(SqlCompanyData $company,SqlAircraftData $aircraft)
    {
        $this->company = $company;
        $this->aircraft = $aircraft;
        $this->middleware('is.admin');
        $this->user =Auth::user();
    }

     public function index(Request $request)
    {
        $companies = $this->company->getId();//ambil companies dari company table
        $companyid = $request->companyid;


        if($request->exists('page'))
            {
                $page = $request->page;
            }
        else
            {
                $page = 1;
            }
        $this->x = (5*($page-1)+1);

        if($request->exists('companyid'))
            {
            $tableaircraft = $this->aircraft->getTable(NULL);
            $sortaircraft = $this->aircraft->sortByCompany($tableaircraft,$companyid);

            $paginatedaircraft = $this->aircraft->getAllPaginated($sortaircraft,5);
            $paginatedaircraft->withPath('/admin/aircraft');



                //show aircraft number registration
                if($request->ajax())
                    {
                        return view('dynamicview.aircraftpagination')->with(['aircraft' => $paginatedaircraft, 'x' => $this->x, 'page' => $page,'company' => $companyid])->render();
                    }

            }else
                {
                    //show view

                    return view('admin.companies',['companies' => $companies, 'x' => $this->x,'companyid' =>    $companyid,'page' => $page,]);
                }
        }



    public function show(Request $request,SqlOrderData $order,SqlDetailServiceData $detailservice,$company,$id)
    {

        $urlaircraft = $id;
        $urlcompany = $company;
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
        $viewdata = $order->getTable('o')
        //start join
        ->join($detailservice->giveAlias('ats'),'o.aircraft_type_service_id','=','ats.id')//untuk dapat detail service
        ->join('users as u','u.id','=','o.userable_id')//untuk tau nama user
        ->join('services as s','s.id','=','ats.service_id')//untuk tau nama service
        ->get(['ats.*','o.*','o.id as id','o.created_at AS o_created_at','o.updated_at AS o_updated_at','ats.id AS ats_id','u.name AS user_name','u.company_id','s.name AS service_name'])//get the collection
        ->where('aircraft_id',$viewaircraft);
        //end join

        $page   =  $request->page?:1;
        $per_page = 1;

        $paginatedviewdata = new LengthAwarePaginator(
            $viewdata->forPage($page, $per_page)->values(), // Only grab the items we need
            count($viewdata), // Total items
            $per_page, // Items per page
            $page, // Current page
            ['path' => $viewaircraft] // We need this so we can keep all old query parameters from the url
        );

        $totalpage = $paginatedviewdata->lastpage();//get total page

        return view('admin.orders',['airtype' => $aircrafttype,'urlaircraft' => $viewaircraft,'viewdata' => $paginatedviewdata , 'x' => $this->x]);
    }

    public function update(Request $request,SqlOrderData $order)
    {

        //update approval order yang aktif
        $selectedorder = $order->getRecordbyId($request->id);
        $selectedorder->update([ "approval" => 1]);
        return back();
    }
}
