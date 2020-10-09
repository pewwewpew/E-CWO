<?php

namespace App\Libraries\Services\Sql;

use Illuminate\Support\Facades\DB;

class SqlAircraftData{

    public function giveAlias($alias)
    {
        $data = 'aircraft AS '.$alias;
        return $data;
    }

    //buat akses tabel
    public function getTable($alias)
    {
        //kalau tidak mau pakai alias  @param $alias = NULL
        if(isset($alias))
        {
            $data = DB::table($this->giveAlias($alias));
            return $data;
        }
        else
        $data = DB::table('aircrafts');
        return $data;
    }

    //get collection dari tabel
    public function getAll()
    {
        $data = $this->getTable(NULL)->get();
        return $data;
    }

    public function getAllPaginated($tabledata,$number)
    {
        $data = $tabledata->paginate($number);
        return $data;
    }

    public function getId($collection)
    {
        $data = $collection->pluck(['id']);

        return $data;
    }

    public function sortByCompany($collection_or_tabledata,$company)
    {
        $data = $collection_or_tabledata->where('company_id',$company);

        return $data;
    }

    public function createNew($aircraft_number,$company,$type)
    {
        $this->aircraft->insert(
            [
            'id' => $aircraft_number,
            'company_id' => $company,
            'aircraft_types_id' => $type,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
            ]);
    }

    //get aircraft registration type value
    public function getTypebyNumber($aircraft)
    {
        $data = $this->getAll()->where('id',$aircraft)->first()->aircraft_types_id;
        return $data;
    }

     //check if data exist
     public function exists($columnname,$input)
     {
        $data = $this->getTable(NULL)->where($columnname,$input)->exists();
        return $data;
     }

     //check if the company really have that aircraft registration
     public function owned($company,$aircraft)
     {
         $data = $this->getTable(NULL)->where('company_id',$company)->where('id',$aircraft)->exists();;
         return $data;
     }
}
