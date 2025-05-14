<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SkillService;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(SkillService $service)
    {
        try {
            $skills = $service->getAll();
            return view("admin.skill.index", compact("skills"));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحميل المهارات');
        }
    }
    
    public function store(Request $request, SkillService $service)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:skills,name',
            ]);
        
            $service->createSkill($request->all());
            return redirect()->route('admin.skill.index')->with("success", "تم اضافة المهارة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة المهارة أو أنها مكررة');
        }
    }

    public function edit($id, SkillService $service)
    {
        
        try {
            $skill = $service->getById($id);
            return view("admin.skill.edit", compact("skill"));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'المهارة غير موجودة أو حدث خطأ أثناء التحميل');
        }
    }
    
    public function update(Request $request, $id, SkillService $service)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:skills,name,' . $id,
            ]);
            
            $service->updateSkill($id, $request->all());
            return redirect()->route('admin.skill.index')->with("success", "تم تحديث المهارة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث المهارة');
        }
    }

    public function destroy($id, SkillService $service)
    {
        try {
            $service->deleteSkill($id);
            return redirect()->route('admin.skill.index')->with("success", "تم حذف المهارة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف المهارة');
        }
    }

    

}
