<?php

namespace App\Services\JobSeeker;

use App\Models\User;
use App\Models\JobSeeker;
use App\UserRole;

class JobSeekerService
{
    public function updateProfile($user_id, array $data)
    {
        // $user->name = $data['name'];
        // $user->last_name = $data['last_name'];
        // $user->email = $data['email'];
        // $user->phone = $data['phone'];
        // $user->save();

        $jobSeeker = JobSeeker::where('user_id', $user_id)->first();
        if (!$jobSeeker) {
            $jobSeeker = new JobSeeker();
            $jobSeeker->user_id = $user_id;
        }
        $jobSeeker->bio = $data['bio'];
        $jobSeeker->is_available = $data['is_available'] ?? true;
        $jobSeeker->hourly_rate = $data['hourly_rate'];
        if (isset($data['profile_picture'])) {
            $path = $data['profile_picture']->store('profiles', 'public');
            $jobSeeker->profile_picture = $path;
        }
        $jobSeeker->experience_level = $data['experience_level'];
        $jobSeeker->save();

        if (isset($data['skills'])) {
            $jobSeeker->skills()->sync($data['skills']);
        }

        if (isset($data['services'])) {
            $jobSeeker->services()->sync($data['services']);
        }
    }

    public function infoSeeker($id)
    {
        return  JobSeeker::with(['skills','services'])->where('user_id',$id)->first();
    }
}
