<?php

namespace App\Repositories;

use App\Models\Employe;

class EmployeRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Employe::class;
    }
}
