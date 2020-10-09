<?php

namespace App\Http\Controllers\Addrecord;

use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlAircraftData;
use App\Libraries\Services\Sql\SqlCompanyData;
use App\Libraries\Services\Sql\SqlDetailServiceData;
use App\Libraries\Services\Sql\SqlOrderData;
use App\Libraries\Services\Sql\SqlServiceData;
use App\Libraries\Services\Sql\SqlUserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddNewOrderController extends Controller
{
    //
    protected $detailservice;
    protected $service;
    protected $company;
    protected $aircraft;
    protected $user;

    public function __construct(SqlDetailServiceData $detailservice,SqlServiceData $service,SqlCompanyData $company,SqlAircraftData $aircraft,SqlUserData $user)
    {
        $this->detailservice = $detailservice;
        $this->service = $service;
        $this->company = $company;
        $this->aircraft = $aircraft;
        $this->user = $user;

    }

    public function var($var)
    {
        $data = [$var];
        return $data;
    }

    public function index()
    {
        $data = $this->detailservice->getAll();
        $service = $this->service->getAll();
        $company = $this->company->getAll();

        $manhours = "Nan";

        if( Auth::user()->roles_id == 'Costumer')
        {
            $role = '';
            $company = Auth::user()->company_id;
            $aircraftcollection = $this->aircraft->getAll();
            $aircraft = $this->aircraft->sortByCompany($aircraftcollection,$company);

            return view('costumers.addmenu.addorder',compact('service','aircraft','role','company','manhours'));
        }else
        $aircraft = [];
        $user = [];
        $role = Auth::user()->roles_id;

        return view('costumers.addmenu.addorder',compact('user','service','aircraft','role','company','manhours'));
    }

    public function store(Request $request,SqlOrderData $order)
    {
        $remark = $request->remark;
        $reqaircraft = $request->aircraft;
        $reqservice = $request->service;

        $userrole = Auth::user()->roles_id;

        //start check if user exist
        if($userrole == "Admin")
        {
            $requser = $request->req_user;
            $requserstats = $this->user->exists('email',$requser);
            if($requserstats == false)
            {

                $targetid = "not exists";
                //error service doesnt exist
            }else
                $targetid = $this->user->getIdbyEmail($requser);
            //end check if user exist
        }
        else
        {
            //cari identitas costumer by email
            $requser = Auth::user()->email;
            $requserstats = $this->user->exists('email',$requser);
            if($requserstats == false)
            {

                $targetid = "not exists";
                //error service doesnt exist
            }else
                $targetid = $this->user->getIdbyEmail($requser);
            //end check if user exist

        }


        //start check if service exists and getservice id
        $reqservicestats = $this->service->exists('name',$reqservice);
        if($reqservicestats == false)
        {
            $serviceid = "not exists";
            //error service doesnt exist
        }else
            $serviceid = $this->service->getIdbyName($reqservice);
        //end check if service exists and getservice id

        //start verified if aircraft exists and get type
        $reqaircraftstats = $this->aircraft->exists('id',$reqaircraft);
        if($reqaircraftstats == false)
        {
            $aircrafttype = "not exists";
            //error service doesnt exist
        }else
        $aircrafttype = $this->aircraft->getTypebyNumber($reqaircraft);
        //end verified if aircraft exists and get type

        //start get detail service id
        $detailserviceid = $this->detailservice->getDetailServiceId($serviceid,$aircrafttype);
        //end get detail service id
        $userid = Auth::user()->id;

        $order->createNew($reqaircraft,$detailserviceid,$userid,$targetid,$remark);




        return redirect('/add-data/order');
    }

    public function getaircrafts(Request $request)
    {
        $company = $request->companyid;
        $collection = $this->aircraft->getAll();
        $sortedaircraft = $this->aircraft->sortByCompany($collection,$company);
        return view('dynamicview.aircraftdropdown')->with(['aircraft' => $sortedaircraft])->render();
    }

    public function getusers(Request $request)
    {
        $company = $request->companyid;
        $usercollection = $this->user->getTable(NULL)->select('name','id','email','company_id','roles_id')->get();
        $sortedusecompany = $this->user->sortByCompany($usercollection,$company);
        $sortedcollection = $this->user->costumerOnly($sortedusecompany);

        return view('dynamicview.userdropdown')->with(['user' => $sortedcollection])->render();
    }

    public function getmanhours(Request $request)
    {
        $reqservice = $request->service;
        $reqaircraft = $request->aircraft;

        //start check if service exists and getservice id
        $reqservicestats = $this->service->exists('name',$reqservice);
        if($reqservicestats == false)
        {
            $serviceid = "not exists";
            //error service doesnt exist
        }else
            $serviceid = $this->service->getIdbyName($reqservice);
        //end check if service exists and getservice id


        //start verified if aircraft exists and get type
        $reqaircraftstats = $this->aircraft->exists('id',$reqaircraft);
        if($reqaircraftstats == false)
        {
            $aircrafttype = "not exists";
            //error service doesnt exist
        }else
        $aircrafttype = $this->aircraft->getTypebyNumber($reqaircraft);
        //end verified if aircraft exists and get type

        //start set manhours value
        if($reqaircraftstats == true & $reqservicestats == true)
        {
            $manhours = $this->detailservice->getManhoursByFk($serviceid,$aircrafttype);
            return view('dynamicview.manhours')->with(['manhours' => $manhours])->render();
        }else
        $manhours = "aircraft or service doesnt exists";
        return view('dynamicview.manhours')->with(['manhours' => $manhours])->render();
        //end set manhours value
    }

}
