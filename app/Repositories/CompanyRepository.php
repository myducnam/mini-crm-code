<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Company::class;
    }
}
