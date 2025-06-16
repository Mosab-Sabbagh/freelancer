<?php

namespace App\Notifications;

use App\Models\JobPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SeekerAcceptedForJob extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $job ; 
    public function __construct($job)
    {
        $this->job = $job; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'تهانينا تم قبولك في الوظيفة!',
            'body'  => 'تم اختيارك لوظيفة : ' . $this->job->title,
            // 'url'   => route('jobPoster.dash'),
            'url'   => route('job.details', $this->job->id),
        ];
    }
}
