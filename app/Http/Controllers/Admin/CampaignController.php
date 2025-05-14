<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CampaignServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    public function index(CampaignServices $service)
    {
        try{
            $campaigns = $service->getAll();
            return view('admin.campaign.index',compact("campaigns"));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحميل المبادرات');
        }
    }

    public function add()
    {
        return view('admin.campaign.create');
    }

    public function store(CampaignServices $service,Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'goal_amount' => 'required|numeric|min:0',
                'raised_amount' => 'required|numeric|min:0',
                'status' => 'required|in:active,cancelled,completed'
            ]);
            $service->createCampaign($request->all());
            return redirect()->route('admin.campaign.index')->with("success",'تم إضافة المبادرة بنجاح');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'حدث خطأ أثناء  إضافة المبادرة..');
        }
    }

    public function edit(CampaignServices $service,$id)
    {
        try{
            $campaign = $service->getById($id);
            return view('admin.campaign.edit',compact("campaign"));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'المبادرة غير موجودة أو حدث خطأ أثناء التحميل');
        }
    }

    public function update(Request $request,CampaignServices $service ,$id)
    {
        try{
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:0',
            'raised_amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,cancelled,completed'
        ]);
        
        $service->updateCampaign($id , $request->all());
        return redirect()->route('admin.campaign.index')->with("success",'تم تحديث المبادرة بنجاح');
        
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث المباردة');
        }
    }
    
    public function destroy(CampaignServices $service ,$id)
    {
        try{
            $service->deleteCampaign($id);
            return redirect()->route('admin.campaign.index')->with("success", "تم حذف المبادرة بنجاح");
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف المبادرة');
        }
        
    }
}
