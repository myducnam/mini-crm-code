<?php

namespace App\Dtos\Admin;

use app\Models\Company;

class CompanyDto
{
    public int $id;

    public string $name;

    public ?string $email;

    public ?string $logo;

    public ?string $website;

    public function __construct(Company $company)
    {
        $this->id = $company->id;
        $this->name = $company->name;
        $this->email = $company->email;
        $this->logo = $company->logo;
        $this->website = $company->website;
    }
}
