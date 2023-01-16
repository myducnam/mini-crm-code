<?php

namespace App\Services\Admin;

use App\Dtos\Admin\EmployeDto;
use App\Repositories\EmployeRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employe;

class EmployeService
{
    private EmployeRepository $employeRepository;
    
    private CompanyRepository $companyRepository;
    
    public function __construct(EmployeRepository $employeRepository, CompanyRepository $companyRepository)
    {
        $this->employeRepository = $employeRepository;
        $this->companyRepository = $companyRepository;
    }

    public function getConfigs(): array
    {
        $header = ['' => __('common.select')];
        $companyArray = $this->companyRepository->getAll()->pluck('name', 'id')->toArray();
        $companies = $header + $companyArray;
        return [
            'companies' => $companies
        ];
    }
    
    public function getFilteredPaginator(array $conditions): LengthAwarePaginator
    {
        $employees = $this->employeRepository->getFilteredPaginator($conditions, []);

        return $employees->through(function ($employe) {
            return new EmployeDto($employe);
        });
    }

    public function updateOrCreate(array $data): Model
    {
        return $this->employeRepository->updateOrCreate(['id' => $data['id'] ?? null], $data);
    }

    public function destroy(Employe $employe): bool
    {
        try {
            $this->employeRepository->destroy($employe->id);

            return true;
        } catch (Exception $ex) {
            Log::error($ex);

            return false;
        }
    }
}
