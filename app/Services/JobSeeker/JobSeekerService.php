<?php

namespace App\Services\JobSeeker;

use App\Models\User;
use App\Models\JobSeeker;

class JobSeekerService
{
    public function updateProfile(User $user, array $data)
    {
        $profile = $user->jobSeekerProfile ?? new JobSeeker(['user_id' => $user->id]);

        $profile->bio = $data['bio'] ?? null;
        $profile->birth_date = $data['birth_date'] ?? null;
        $profile->skills = $data['skills'] ?? [];

        // صورة
        if (request()->hasFile('profile_picture')) {
            $path = request()->file('profile_picture')->store('profiles', 'public');
            $profile->profile_picture = $path;
        }

        $profile->specialization = $data['specialization'] ?? null;
        $profile->field = $data['field'] ?? null;
        $profile->experience_level = $data['experience_level'] ?? null;
        $profile->available = isset($data['available']) ? true : false;
        $profile->hourly_rate = $data['hourly_rate'] ?? null;

        $profile->save();
    }
}
