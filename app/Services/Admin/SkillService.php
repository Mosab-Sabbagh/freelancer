<?php 
namespace App\Services\Admin;
use App\Models\Skill;
class SkillService{
    public function createSkill($data){
        $skill = new Skill();
        $skill->name = $data["name"];
        $skill->save();
    }

    public function getAll()
    {
        // return  Skill::paginate(5);
        return  Skill::get();
    }

    public function getById($id)
    {
        return Skill::findOrFail($id);
    }

    public function updateSkill($id, $data)
    {
        $skill = Skill::find($id);
        $skill->name = $data["name"];
        $skill->save();
    }

    public function deleteSkill($id)
    {
        $skill = Skill::find($id);
        $skill->delete();
    }
}