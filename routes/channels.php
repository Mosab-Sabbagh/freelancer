<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    if (!Auth::check()) {
        return false;
    }

    try {
        $chat = Chat::findOrFail($chatId);
        
        // التحقق من أن المستخدم هو إما صاحب المشروع أو طالب العمل
        $isPoster = $user->user_type === 'job_poster' && $chat->poster_id === $user->jobPoster->id;
        $isSeeker = $user->user_type === 'job_seeker' && $chat->seeker_id === $user->JobSeeker->id;

        return $isPoster || $isSeeker;
    } catch (\Exception $e) {
        Log::error('Broadcast channel auth error: ' . $e->getMessage());
        return false;
    }
});
