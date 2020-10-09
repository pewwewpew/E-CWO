<?php

namespace App\Http\Controllers\Addrecord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Services\Sql\SqlAircraftTypeData;

class AddAircraftTypeController extends Controller
{
    //
    private $airtype;

        public function __construct(SqlAircraftTypeData $aircrafttype)
        {
            $this->airtype = $aircrafttype;
        }

        public function index()
        {
            return view('costumers.addmenu.addairtype');
        }

        public function store(Request $request)
        {
            $input = $request->all();
            $this->airtype->createNew($input['airtype']);

            return redirect('/add-data/aircraft-type');
        }

}
