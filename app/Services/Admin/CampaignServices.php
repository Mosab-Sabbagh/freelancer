<?php 
namespace App\Services\Admin;

use App\Models\Campaign;
class CampaignServices{
    public function createCampaign($data){
        $campaign = new Campaign();
        $campaign->name = $data['name'];
        $campaign->description = $data['description'];
        $campaign->goal_amount = $data['goal_amount'];
        $campaign->raised_amount = $data['raised_amount'];
        $campaign->status = $data['status'];
        $campaign->save();
    }

    public function getAll()
    {
        return Campaign::get();
    }

    public function getById($id)
    {
        return Campaign::findOrFail($id);
    }
    
    function updateCampaign($id,$data)
    {
        $campaign = Campaign::find($id);
        $campaign->name = $data['name'];
        $campaign->description = $data['description'];
        $campaign->goal_amount = $data['goal_amount'];
        $campaign->raised_amount = $data['raised_amount'];
        $campaign->status = $data['status'];
        $campaign->save();
    }

    public function deleteCampaign($id)
    {
        Campaign::find($id)->delete();
    }
    
}