<?php

namespace App\Libraries\Services\Sql;

use Illuminate\Support\Facades\DB;

class SqlAircraftTypeData{

    public function giveAlias($alias)
    {
        $data = 'aircraft_types AS '.$alias;
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
        $data = DB::table('aircraft_types');
        return $data;
    }

    public function getAll()
    {
        $data = $this->getTable(NULL)->get();;
        return $data;
    }

    public function getAllPaginated($collection,$number)
    {
        $data = $collection->paginate($number);
        return $data;
    }

    public function getId($collection)
    {
        $data = $collection->pluck('id');

        return $data;
    }

    public function createNew($airtypeid)
    {

        $this->airtype->insert(
            array(
                'id'=> $airtypeid,
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            )
            );
    }



}
