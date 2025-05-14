<?php 
namespace App\Services\Admin;
use App\Models\Service;

class ServiceService{
    public function createService($data){
        $service = new Service();
        $service->name = $data["name"];
        $service->save();
    }
    
    public function getAll(){
        return  Service::paginate(5);
    }

    public function getById($id)
    {
        return Service::findOrFail($id);
    }

    public function updateService($id, $data)
    {
        $service = Service::find($id);
        $service->name = $data["name"];
        $service->save() ;
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();
    }
}