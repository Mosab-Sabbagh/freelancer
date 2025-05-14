<?php 
namespace App\Services\Admin;

use App\Models\Workspace;

class WorkspaceService{
    public function getAll()
    {
        return Workspace::paginate(5);
    }

    public function createWorkspace($data)
    {
        $workspace = new Workspace();
        $workspace->owner_name=$data['owner_name'];
        $workspace->governorate=$data['governorate'];
        $workspace->address=$data['address'];
        $workspace->phone_number=$data['phone_number'];
        $workspace->available_time=$data['available_time'];
        $workspace->save();
    }

    public function getById($id)
    {
        return Workspace::findOrFail($id);
    }

    public function updateWorksoace($id,$data)
    {
        $workspace = Workspace::find($id);
        $workspace->owner_name=$data['owner_name'];
        $workspace->governorate=$data['governorate'];
        $workspace->address=$data['address'];
        $workspace->phone_number=$data['phone_number'];
        $workspace->available_time=$data['available_time'];
        $workspace->save();
    }
    
    public function deleteworkspace($id)
    {
        $workspace = Workspace::find($id);
        $workspace->delete();
    }
    
}