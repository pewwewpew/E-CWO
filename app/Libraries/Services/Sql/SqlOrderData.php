<?php

namespace App\Libraries\Services\Sql;

use Illuminate\Support\Facades\DB;

class SqlOrderData{

    public function giveAlias($alias)
    {
        $data = 'orders AS '.$alias;
        return $data;
    }

    public function getTable($alias)
    {
        //kalau tidak mau pakai alias  @param $alias = NULL
        if(isset($alias))
        {
            $data = DB::table($this->giveAlias($alias));
            return $data;
        }
        else
        $data = DB::table('orders');
        return $data;
    }

    public function getAll()
    {
        $data = $this->getTable(NULL)->get();
        return $data;
    }

    //create new record
    public function createNew($aircraft,$detailservice,$userid,$targetid,$remark)
    {
        $this->getTable(NULL)->insert(
            [
            'aircraft_id' => $aircraft,
            'aircraft_type_service_id' => $detailservice,
            'userable_id' => $userid,
            'target_user_id' => $targetid,
            'remark' => $remark,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
            ]);
    }

    //find id of service by name
    public function getIdbyName($value)
    {
        $data = $this->getAll()->where('name',$value)->first()->id;
        return $data;
    }


     //check if data exist
     public function exists($columnname,$input)
     {
        $data = $this->getTable(NULL)->where($columnname,$input)->exists();
        return $data;
     }

     //get record by their id
     public function getRecordbyId($id)
     {
         $data = $this->getTable(NULL)->where('id',$id);
         return $data;
     }

}
