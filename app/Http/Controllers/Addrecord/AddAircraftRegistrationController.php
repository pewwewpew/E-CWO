<?php

namespace App\Http\Controllers\Addrecord;

use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlAircraftData;
use App\Libraries\Services\Sql\SqlAircraftTypeData;
use App\Libraries\Services\Sql\SqlCompanyData;
use Illuminate\Http\Request;
use Auth;


class AddAircraftRegistrationController extends Controller
{
    //
    protected $company;
    protected $airtype;
    protected $aircraft;

    public function __construct(SqlCompanyData $company,SqlAircraftData $aircraft,SqlAircraftTypeData $airtype)
    {
        $this->company = $company;
        $this->aircraft = $aircraft;
        $this->airtype = $airtype;
    }

    public function index()
    {
        $company =  $this->company->getAll();
        $airtype =  $this->airtype->getAll();
        return view('costumers.addmenu.addaircraft',compact('company','airtype'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $companycollection = $this->company->getTable(NULL)->select('id')->get()->where('id',$input['company']);
        $company = $companycollection->first()->id;
        $airtypecollection = $this->airtype->getTable(NULL)->select('id')->get();
        $type = $airtypecollection->where('id',$input['type'])->first()->id;

        $this->aircraft->createNew($input['aircraft_number'],$company,$type);

        return redirect('/add-data/aircraft-registration');
    }
}
