<?php

namespace App\Http\Controllers;

use App\Aircraft;
use App\AircraftType;
use App\Company;
use App\Libraries\AdminAircraftView;
use App\Libraries\Interfaces\UserAuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Test1Controller extends Controller
{
    //


    private $company;
    private $airtype;
    private $aircraft;

    public function __construct(Company $company,AircraftType $aircraftype,Aircraft $aircraft)
    {
        $this->company = $company;
        $this->airtype = $aircraftype;
        $this->aircraft = $aircraft;
    }

    public function testing()
    {
        $company = $this->company->get();
        $sqlcompany = DB::table('companies')->get();
        $airtype = $this->airtype->get();
        $aircraft = $this->aircraft->get();
        return view('test',compact('sqlcompany','airtype','aircraft'));


    }

    public function test(Request $request)
    {
        $data1 = $request->data1;
        $data2 = $request->data2;
        $aircraft = $this->aircraft->where('company_id',$data1)->get();

        return response()->json([
            'data1' => $data1,
            'data2' => $data2,
            'collection' => $aircraft,
        ]);

    }

    public function dinamic()
    {
        return view("dynamicview.dinamictest")->render();
    }

    public function dinamic2()
    {
        return view("dynamicview.dinamictest2")->render();
    }

    public function query(Request $request)
    {
        dd($request);
    }

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;

            $data = DB::table('users')->select('id', 'email')->where('email', 'LIKE', '%'.$cari.'%')->get();

            return response()->json($data);
        }
    }

}
