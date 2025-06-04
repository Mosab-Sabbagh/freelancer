<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\JobSeeker;
use App\Models\Project;
use App\Services\Chat\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function createOrGetChat($projectId, $seekerId)
    {
        
        $poster = Auth::user();
        // تحقق من أن المشروع يخص هذا البوستر 
        $project = Project::where('id', $projectId)
                        ->where('job_poster_id', $poster->jobPoster->id)
                        ->firstOrFail();

        // dd(['posterId => ' .$poster->jobPoster->id , 'seekerId => '. $seekerId]);

        // جلب أو إنشاء المحادثة
        $chat = Chat::firstOrCreate([
            'project_id' => $projectId,
            'seeker_id' => $seekerId,
            'poster_id' => $poster->jobPoster->id,
        ]);


        return redirect()->route('chat.show', $chat->id);
    }

    public function show($id)
    {
        $chat = Chat::with(['seeker','poster','messages.sender'])->findOrFail($id);

        $user = Auth::user();

        $isPoster = $user->user_type === 'job_poster' && $chat->poster_id === $user->jobPoster->id;
        $isSeeker = $user->user_type === 'job_seeker' && $chat->seeker_id === $user->JobSeeker->id;

        if (! $isPoster && ! $isSeeker) {
            return redirect()->route('chat.index')->with(['error' => 'ليس لديك صلاحية للوصول إلى هذه المحادثة.']);
            // abort(403, 'ليس لديك صلاحية للوصول إلى هذه المحادثة.');
        }

        return view('chat.show', compact('chat'));
    }


    public function send(Request $request, $id, ChatService $chatService)
    {
        $chat = Chat::findOrFail($id);
        $user = Auth::user();

        $isPoster = $user->user_type === 'job_poster' && $chat->poster_id === $user->jobPoster->id;
        $isSeeker = $user->user_type === 'job_seeker' && $chat->seeker_id === $user->JobSeeker->id;

        if (! $isPoster && ! $isSeeker) {
            abort(403, 'محاولة وصول غير مسموح بها.');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $senderModel = $user->user_type === 'job_poster' ? $user->jobPoster : $user->JobSeeker;

        $chatService->sendMessage($chat, $senderModel, $request->message);
        
        
        return redirect()->route('chat.show', $chat->id);
    }



    public function index(ChatService $chatService)
    {
        $user = Auth::user();
        $chats = $chatService->getUserChats($user);

        return view('chat.index', compact('chats'));
    }







}
