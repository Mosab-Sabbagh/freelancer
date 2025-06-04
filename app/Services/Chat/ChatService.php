<?php

namespace App\Services\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Events\MessageSent;

class ChatService
{
public function sendMessage(Chat $chat, $senderModel, string $messageContent)
{
    $message = $chat->messages()->create([
        'sender_type' => get_class($senderModel),
        'sender_id' => $senderModel->id,
        'message' => $messageContent,
    ]);

    broadcast(new MessageSent($message, $senderModel))->toOthers(); // بث الرسالة

    return $message;
}

    public function getUserChats($user)
    {
        if ($user->user_type === 'job_poster') {
            return Chat::where('poster_id', $user->jobPoster->id)
                ->with(['seeker', 'messages'])
                ->get();
        }

        return Chat::where('seeker_id', $user->JobSeeker->id)
            ->with(['poster', 'messages'])
            ->get();
    }
}
