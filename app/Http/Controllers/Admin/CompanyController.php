<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Admin\CompanyDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyCreateOrUpdateRequest;
use App\Models\Company;
use App\Services\Admin\CompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(): View
    {
        $companies = $this->companyService->getFilteredPaginator([]);
        return view('admin.company.index', [
            'companies' => $companies
        ]);
    }

    public function destroy(Company $company): RedirectResponse
    {
        try {
            if (! $this->companyService->destroy($company)) {
                return to_route('admin.company.index')
                    ->with(['alert' => __('message.failed to delete')]);
            }

            return to_route('admin.company.index')
                ->with(['success' => __('message.has been deleted')]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return to_route('admin.company.index')
                ->with(['alert' => __('message.system error')]);
        }
    }

    public function create(): View
    {
        return view('admin.company.create');
    }

    public function store(CompanyCreateOrUpdateRequest $request): RedirectResponse
    {
        try {
            $this->companyService->updateOrCreate($request->validated());

            return to_route('admin.company.index')
                ->with(['success' => __('message.has registered')]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return to_route('admin.company.index')
                ->with(['alert' => __('message.system error')]);
        }
    }

    public function edit(Company $company): View
    {
        $companyDto = new CompanyDto($company);
        $data = [
            'company' => $companyDto
        ];

        return view('admin.company.edit', $data);
    }

    public function update(CompanyCreateOrUpdateRequest $request): RedirectResponse
    {
        try {
            if ($this->companyService->updateOrCreate($request->validated())) {
                return to_route('admin.company.index')
                    ->with(['success' => __('message.has been updated')]);
            }

            return to_route('admin.company.index')
                ->with(['alert' => __('message.update failed')]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return to_route('admin.company.index')
                ->with(['alert' => __('message.system error')]);
        }
    }
}
