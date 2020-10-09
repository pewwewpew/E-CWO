<?php

namespace App\Libraries\Services\Sql;

use Illuminate\Support\Facades\DB;

class SqlUserData{

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
        $data = DB::table('users');
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

     //find id of user by name
     public function getIdbyEmail($value)
     {
         $data = $this->getAll()->where('email',$value)->first()->id;
         return $data;
     }

     //check if data exist
     public function exists($columnname,$input)
     {
        $data = $this->getTable(NULL)->where($columnname,$input)->exists();
        return $data;
     }

     public function costumerOnly($collection)
     {
         $data = $collection->where('roles_id','Costumer');
         return $data;
     }

}
