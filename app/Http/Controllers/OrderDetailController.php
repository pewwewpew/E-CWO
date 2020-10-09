<?php

namespace App\Http\Controllers;

use App\Libraries\Services\Sql\SqlDetailServiceData;
use App\Libraries\Services\Sql\SqlOrderData;
use Illuminate\Http\Request;
use Auth;

class OrderDetailController extends Controller
{
    public function __construct()
    {

    }
    //
    public function index($var1,$var2,Request $request,SqlOrderData $order,SqlDetailServiceData $detailservice)
    {
        $user = Auth::user();
        //get previous request url

        $viewdata = $order->getTable('o')
        //start join
        ->join($detailservice->giveAlias('ats'),'o.aircraft_type_service_id','=','ats.id')//untuk dapat detail service
        ->join('users as u','u.id','=','o.userable_id')//untuk tau nama user yang request
        ->join('users as t','t.id','=','o.target_user_id')//untuk tau nama user yang dituju
        ->join('services as s','s.id','=','ats.service_id')//untuk tau nama service
        ->get(['ats.*','o.*','o.id as id','o.created_at AS o_created_at','o.updated_at AS o_updated_at','ats.id AS ats_id','u.name AS user_name','u.company_id','s.name AS service_name','t.name AS target_name'])//get the collection
        ->where('id',$request->id);

        if( $user->roles_id == 'Admin')
        {
            $url = '/admin/aircraft/'.$var1.'/'.$var2;
            return view('admin.orderdetail',compact('viewdata','url'));
        }else
            $url = '/aircraft/'.$var1.'/orders?';
            return view('costumers.orderdetail',compact('viewdata','url'));

    }
}
