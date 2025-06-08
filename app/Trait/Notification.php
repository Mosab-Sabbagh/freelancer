<?php

namespace App\Trait;

trait Notification
{
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }
}
