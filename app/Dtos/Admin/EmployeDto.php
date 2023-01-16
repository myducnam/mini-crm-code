<?php

namespace App\Dtos\Admin;

use app\Models\Employe;

class EmployeDto
{
    public int $id;

    public string $firstName;

    public string $lastName;

    public ?string $email;

    public ?string $phone;

    public ?string $company;
    
    public ?string $company_id;

    public function __construct(Employe $employe)
    {
        $this->id = $employe->id;
        $this->firstName = $employe->first_name;
        $this->lastName = $employe->last_name;
        $this->email = $employe->email;
        $this->phone = $employe->phone;
        $this->company = $employe->company?->name;
        $this->company_id = $employe->company?->id;
    }
}
