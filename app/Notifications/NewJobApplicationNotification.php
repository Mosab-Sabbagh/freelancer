<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewJobApplicationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $job_application; 
    public function __construct($job_application)
    {
        $this->job_application = $job_application ; 
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
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'تم تقديم  عرض  جديد للوظيفة :'. $this->job_application->job->title,
            'body'  => 'مقدم الطلب ' . $this->job_application->jobSeeker->user->name,
            'url'   => route('poster.job.applications', $this->job_application->job->id),
        ];
    }
}
