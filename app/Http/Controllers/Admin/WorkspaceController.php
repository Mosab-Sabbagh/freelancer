<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Workspace;
use App\Services\Admin\WorkspaceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkspaceController extends Controller
{
    public function index(WorkspaceService $service)
    {
        try{
            $workspaces = $service->getAll();
            return view('admin.workspace.index',compact("workspaces"));
        }catch(Exception $e)
        {
            Log::info($e);
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحميل مساحات العمل');
        }
    }

    public function store(Request $request,WorkspaceService $service)
    {
        try{
            $request->validate([
                'owner_name' => 'required|string|max:255|unique:workspaces,owner_name',
                'governorate' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'available_time' => 'required|string|max:255'
            ]);
            $service->createWorkspace($request->all());
            return redirect()->route('admin.workspace.index')->with('success','تم اضافة المساحة بنجاح');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة المساحة أو أنها مكررة');
        }
    }
    
    public function edit(WorkspaceService $service,$id)
    {
        try{
            $workspace = $service->getById($id);
            return view("admin.workspace.edit", compact("workspace"));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'المساحة غير موجودة أو حدث خطأ أثناء التحميل');
        }
    }
    
    public function update(Request $request,WorkspaceService $service,$id)
    {
        try{

            $request->validate([
                'owner_name' => 'required|string|max:255',
                'governorate' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'available_time' => 'required|string|max:255'
            ]);

            $service->updateWorksoace($id, $request->all());
            return redirect()->route('admin.workspace.index')->with("success", "تم تحديث المساحة بنجاح");
        }catch(Exception $e){
            Log::info($e);
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث المساحة');
        }
    }

    public function destroy(WorkspaceService $service, $id)
    {
        try {
            $service->deleteworkspace($id);
            return redirect()->route('admin.workspace.index')->with("success", "تم حذف المساحة بنجاح");
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف المساحة');
        }
    }
    

}
