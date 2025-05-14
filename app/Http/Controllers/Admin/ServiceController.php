<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Admin\ServiceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function index(ServiceService $service){
        try {
            $services = $service->getAll();
            return view("admin.service.index", compact("services"));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحميل الخدمات');
        }
    }

    public function store(Request $request, ServiceService $service){
        try{
            $request->validate([
                'name' => 'required|string|max:255|unique:skills,name',
            ]);
            $service->createService($request->all());
            return redirect()->route('admin.service.index')->with("success", "تم اضافة الخدمة بنجاح");
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة الخدمة أو أنها مكررة');
        }
    }
    
    public function edit(ServiceService $service,$id)
    {
        try{
            $service = $service->getById($id);
            return view("admin.service.edit", compact("service"));
        }catch(Exception $e)
        {
            return redirect()->back()->with('error','الخدمة غير موجودة أو حدث خطأ أثناء التحميل');
        }
    }

    public function update(Request $request, $id, ServiceService $service)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255|unique:services,name,' . $id,
            ]);
            $service->updateService($id,$request->all());
            return redirect()->route('admin.service.index')->with("success", "تم تحديث الخدمة بنجاح");
        } catch (Exception $e) {
            Log::info($e);
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الخدمة');
        }
    }

    public function destroy(ServiceService $service,$id)
    {
        try{
            $service->deleteService($id);
            return redirect()->route('admin.service.index')->with("success", "تم حذف الخدمة بنجاح");
        }catch(Exception $e)
        {
            return redirect()->route('admin.service.index')->with('error', 'حدث خطأ أثناء حذف الخدمة');
        }
    }
}
