<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Admin\EmployeDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeCreateOrUpdateRequest;
use App\Models\Employe;
use App\Services\Admin\EmployeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EmployeController extends Controller
{
    private EmployeService $employeService;

    public function __construct(EmployeService $employeService)
    {
        $this->employeService = $employeService;
    }

    public function index(): View
    {
        $employees = $this->employeService->getFilteredPaginator([]);
        return view('admin.employe.index', [
            'employees' => $employees
        ]);
    }

    public function destroy(Employe $employe): RedirectResponse
    {
        try {
            if (! $this->employeService->destroy($employe)) {
                return to_route('admin.employe.index')
                    ->with(['alert' => __('message.failed to delete')]);
            }

            return to_route('admin.employe.index')
                ->with(['success' => __('message.has been deleted')]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return to_route('admin.employe.index')
                ->with(['alert' => __('message.system error')]);
        }
    }

    public function create(): View
    {
        return view('admin.employe.create',[
                    'configs' => $this->employeService->getConfigs()
        ]);
    }

    public function store(EmployeCreateOrUpdateRequest $request): RedirectResponse
    {
        try {
            $this->employeService->updateOrCreate($request->validated());

            return to_route('admin.employe.index')
                ->with(['success' => __('message.has registered')]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return to_route('admin.employe.index')
                ->with(['alert' => __('message.system error')]);
        }
    }

    public function edit(Employe $employe): View
    {
        $employeDto = new EmployeDto($employe);
        $data = [
            'employe' => $employeDto,
            'configs' => $this->employeService->getConfigs()
        ];

        return view('admin.employe.edit', $data);
    }

    public function update(EmployeCreateOrUpdateRequest $request): RedirectResponse
    {
        try {
            if ($this->employeService->updateOrCreate($request->validated())) {
                return to_route('admin.employe.index')
                    ->with(['success' => __('message.has been updated')]);
            }

            return to_route('admin.employe.index')
                ->with(['alert' => __('message.update failed')]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return to_route('admin.employe.index')
                ->with(['alert' => __('message.system error')]);
        }
    }
}
