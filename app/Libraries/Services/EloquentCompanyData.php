<?php

namespace App\Libraries\Services;

use App\Company;

class EloquentCompanyData{

    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getAll()
    {
        $data = $this->company->get();
        return $data;
    }

    public function getId()
    {
        $data = $this->getAll()->pluck(['id']);

        return $data;
    }

}
