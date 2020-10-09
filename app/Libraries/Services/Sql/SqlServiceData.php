<?php

namespace App\Libraries\Services\Sql;

use Illuminate\Support\Facades\DB;

class SqlServiceData{

    public function giveAlias($alias)
    {
        $data = 'services AS '.$alias;
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
        $data = DB::table('services');
        return $data;
    }

    public function getAll()
    {
        $data = $this->getTable(NULL)->get();
        return $data;
    }

    public function createNew($service)
    {
        $this->getTable(NULL)->insert(
            [
            'name' => $service,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
            ]);
    }

    public function getIdVal($collection)
    {
        $data = $collection->first()->id;
        return $data;
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

}
