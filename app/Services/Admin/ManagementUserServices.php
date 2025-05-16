<?php 
namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagementUserServices{
    public function getAll()
    {
        return User::paginate(10);
    }
    
    public function createUser($data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->email  = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->user_type  = $data['user_type'];
        $user->status  = $data['status'];
        $user->save();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }
}