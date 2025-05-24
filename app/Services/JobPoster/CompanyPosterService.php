<?php
namespace App\Services\JobPoster;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyPosterService{

    public  function updateCompany(array $data, $logoFile = null, $id)
    {
        $company = Company::findOrFail($id);

        // إذا تم رفع صورة جديدة
        if ($logoFile) {
            // حذف القديمة إن وجدت
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $data['logo'] = $logoFile->store('companies_logo', 'public');
        } else {
            // لا تغيير على الشعار، احتفظ بالقديم
            $data['logo'] = $company->logo;
        }

        $company->update($data);
    }
}