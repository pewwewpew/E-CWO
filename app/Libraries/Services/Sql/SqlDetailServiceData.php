<?php

namespace App\Libraries\Services\Sql;

use Illuminate\Support\Facades\DB;

class SqlDetailServiceData{
    //ini query builder untuk tabel dengan nama "aircraft_type_service"

    public function giveAlias($alias)
    {
        $data = 'aircraft_type_service AS '.$alias;
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
        $data = DB::table('aircraft_type_service');
        return $data;

    }

    public function getAll()
    {
        $data = $this->getTable(NULL)->get();
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

    public function createNew($serviceid,$airtypeid,$manhours)
    {

        $this->getTable(NULL)->insert(
            array(
                'service_id'=> $serviceid,
                'aircraft_type_id' => $airtypeid,
                'manhours' => $manhours,
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            )
            );
    }

    //check if data exist
    public function exists($servicefk,$typefk)
    {
       $data = $this->getTable(NULL)->where('service_id',$servicefk)->where('aircraft_type_id',$typefk)->exists();
       return $data;
    }

    //get record id by FK
    public function getDetailServiceId($servicefk,$typefk)
    {
        $status = $this->exists($servicefk,$typefk);
        if($status == false)
        {
            $data = "service not exists";
            return $data;
        }else
        $data = $this->getAll()->where('service_id',$servicefk)->where('aircraft_type_id',$typefk)->first()->id;
        return $data;
    }

    //get manhours
    public function getManhoursByFk($servicefk,$typefk)
    {
        $status = $this->exists($servicefk,$typefk);
        if($status == false)
        {
            $data = "manhours not exists";
            return $data;
        }else
        $data = $this->getAll()->where('service_id',$servicefk)->where('aircraft_type_id',$typefk)->first()->manhours;
        return $data;
    }

}
