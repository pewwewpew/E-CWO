<?php

namespace App\Http\Controllers\Costumer;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlAircraftData;
use Illuminate\Pagination\LengthAwarePaginator;

class AircraftController extends Controller
{
    //
    protected $aircraft;

    public function __construct(SqlAircraftData $aircraft)
    {
        $this->aircraft = $aircraft;
    }

    public function index(Request $request)
    {
        $usercompany = Auth::user()->company_id;
        $aircraftcollection = $this->aircraft->getAll();
        $viewdata = $this->aircraft->sortByCompany($aircraftcollection,$usercompany);

        $page   =  $request->page?:1;
        $per_page = 5;
        $offset = ($page * $per_page) - $per_page;

        $paginatedviewdata = new LengthAwarePaginator(
            $viewdata->forPage($page, $per_page)->values(), // Only grab the items we need
            count($viewdata), // Total items
            $per_page, // Items per page
            $page, // Current page
            ['path' => 'aircraft'] // We need this so we can keep all old query parameters from the url
        );

        $totalpage = $paginatedviewdata->lastpage();//get total page

        $x=$offset;
        return view('costumers.aircraft',compact('paginatedviewdata','x','usercompany'));
    }

    public function store()
    {
        $data=request('aircraft_number');
        $userCompany = Auth::user()->company()->first();
        $userCompany->aircrafts()->create(['id'=> $data ,'company_id'=>$userCompany->id ]);


        return redirect('/aircraft');
    }
}
