<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManagementUserServices;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\JobSeeker\JobSeekerService;
use App\UserRole;
use Exception;

class ManagementUserController extends Controller
{
    public function index(ManagementUserServices $service)
    {
        try{
            $users = $service->getAll();
            return view('admin.user.index',compact("users"));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحميل المستخدمين');
        }
    }

    public function add()
    {
        return view('admin.user.create');
    }

    public function store(Request $request,ManagementUserServices $service )
    {
        try{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'user_type' => ['required'],
                'password' => ['required',],
            ]);
            $service->createUser($request->all());
            return redirect()->route('admin.user.index')->with("success",'تم إضافة نستخدم بنجاح');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'حدث خطأ أثناء  اضافة المستخدم..');
        }
    }

    public function destroy(ManagementUserServices $service , $id)
    {
        try{
            $service->deleteUser($id);
            return redirect()->route('admin.user.index')->with("success","تم حذف المستخدم بنجاح");
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف المستخدم');
        }
    }


    public function show(JobSeekerService $jobSeeker,ManagementUserServices $management_user ,$id)
    {
        $user = $management_user->getById($id);
        if($user->user_type == UserRole::JOB_SEEKER){
            $seeker = $jobSeeker->infoSeeker($id);
            return view('admin.user.info',compact("seeker","user"));
        }else{
            return "ليس بعد ";
        }
    }
}
