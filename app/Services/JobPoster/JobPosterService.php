<?php
namespace App\Services\JobPoster;

use App\Models\JobPoster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class JobPosterService{


    // edit for individual and company
    public function getEditViewData()
    {
        $jobPoster = Auth::user()->jobPoster;

        if (!$jobPoster) {
            return ['view' => null, 'error' => 'لا يوجد ملف تعريفي لهذا المستخدم.'];
        }

        if ($jobPoster->poster_type === 'individual') {
            return [
                'view' => 'jobPoster.profile.editIndividual',
                'data' => ['jobPoster' => $jobPoster]
            ];
        }

        if ($jobPoster->poster_type === 'company') {
            return [
                'view' => 'jobPoster.company.edit',
                'data' => ['jobPoster' => $jobPoster]
            ];
        }

        return ['view' => null, 'error' => 'هناك خلل ما'];
    }

    public function updateJobPoster(Request $request, $id)
    {
        $jobPoster = JobPoster::find($id);

        if (!$jobPoster) {
            return false;
        }

        $data = [
            'phone' => $request->phone,
            'bio' => $request->bio,
        ];

        if ($request->hasFile('profile_image')) {
            // احذف الصورة القديمة إن وجدت
            if ($jobPoster->profile_image) {
                Storage::disk('public')->delete($jobPoster->profile_image);
            }

            $data['profile_image'] = $request->file('profile_image')->store('jobPosters', 'public');
        }

        $jobPoster->update($data);

        return true;
    }

    // info for individual and company using this function for managmentUser -> admin .... 
    public function info($id)
    {
        return  JobPoster::with(['user','company','projects'])->where('user_id',$id)->first();
    }

}