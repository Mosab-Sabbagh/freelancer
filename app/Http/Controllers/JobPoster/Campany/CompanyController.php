<?php

namespace App\Http\Controllers\JobPoster\Campany;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Services\JobPoster\CompanyPosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function update(Request $request,CompanyPosterService $service, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('companies')->ignore($id)],
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $service->updateCompany($validated, $request->file('logo'), $id);
    
        return redirect()->route('jobPoster.dash')->with('success', 'تم تحديث البيانات بنجاح');
    }
}
