<?php

namespace App\Libraries\Services\Sql;

use Illuminate\Support\Facades\DB;

class SqlCompanyData{

    public function giveAlias($alias)
    {
        $data = 'companies AS '.$alias;
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
        $data = DB::table('companies');
        return $data;
    }

    public function getAll()
    {
        $data = $this->getTable(NULL)->get();
        return $data;
    }

    public function createNew($companyid)
    {

        $this->company->insert(
            array(
                'id'=> $companyid,
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            )
            );
    }

    //sorting collection method
    public function getId()
    {
        $data = $this->getAll()->pluck(['id']);

        return $data;
    }

}
