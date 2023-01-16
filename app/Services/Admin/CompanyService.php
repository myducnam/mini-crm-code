<?php

namespace App\Services\Admin;

use App\Dtos\Admin\CompanyDto;
use App\Repositories\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use Illuminate\Http\UploadedFile;
use App\Services\Common\FileService;

class CompanyService
{
    private CompanyRepository $companyRepository;

    protected $fileService;
    
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->fileService = new FileService('public');
        $this->uploadDirectory = '';
    }

    public function getFilteredPaginator(array $conditions): LengthAwarePaginator
    {
        $companies = $this->companyRepository->getFilteredPaginator($conditions, []);

        return $companies->through(function ($company) {
            return new CompanyDto($company);
        });
    }

    public function updateOrCreate(array $data): Model
    {
        if (!empty($data['logo'])) {
            $logo = $this->uploadLogo($data['logo']);
            if (!empty($logo)) {
                $data['logo'] = $logo;
                $company = $this->companyRepository->getByPK($data['id']);
                $oldLogo = $company->logo;

                if($this->fileService->exists($this->uploadDirectory, $oldLogo)){
                    $this->fileService->deleteFile($oldLogo);
                }
            }
        }
        return $this->companyRepository->updateOrCreate(['id' => $data['id'] ?? null], $data);
    }

    private function uploadLogo(UploadedFile $image): string
    {
        $file = $image->getClientOriginalName();
        $name = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newFileName = $name. '_' .time().'.' .$extension;
        $isUploadSuccess = $this->fileService->uploadFile($this->uploadDirectory, $newFileName, $image->get());
        $fileFath = '';
        if ($isUploadSuccess) {
            $fileFath = sprintf('%s%s', $this->uploadDirectory, $newFileName);
        }        
        return $fileFath;
    }

    public function destroy(Company $company): bool
    {
        try {
            $logo = $company->logo;
            if($this->fileService->exists($this->uploadDirectory, $logo)){
                $this->fileService->deleteFile($logo);
            }

            $this->companyRepository->destroy($company->id);

            return true;
        } catch (Exception $ex) {
            Log::error($ex);

            return false;
        }
    }
}
