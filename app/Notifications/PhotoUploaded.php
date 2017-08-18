<?php

namespace App\Notifications;

use App\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PhotoUploaded extends Notification
{
    use Queueable;

    /**
     * @var \App\Photo
     */
    protected $photo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('photos.show', ['id' => $this->photo->id]);

        return (new MailMessage)
            ->subject('Photo Uploaded')
            ->markdown('mail.photos.uploaded', compact('url'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
