<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    // public function markAsRead($id)
    // {
    //     $notification = DatabaseNotification::findOrFail($id);
    //     if ($notification->notifiable_id == Auth::user()->jobSeeker->id &&
    //         $notification->notifiable_type == get_class(Auth::user()->jobSeeker)) {

    //         $notification->markAsRead();

    //         // إعادة التوجيه إلى الرابط داخل الإشعار
    //         return redirect($notification->data['url'] ?? '/');
    //     }

    //     abort(403);
    // }

    public function markAsRead($id)
    {
        $notification = DatabaseNotification::findOrFail($id);

        if($notification){
            $notification->markAsRead();
            return redirect($notification->data['url'] ?? '/');
        }

        abort(403);
    }
}
