<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddNewMember extends Notification
{
    use Queueable;
    private $username;
    private $teamname;
    private $manager;
    private $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($username,$teamname,$manager)
    {
        $this->username = $username;
        $this->teamname =$teamname;
        $this->manager  =$manager;
        $this->url = route('teams.teams');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('You have been added to New Team')
            ->markdown('emails/Team/AddNewMember',[
                'username'=>$this->username,
                'team'=>$this->teamname,
                'manager'=>$this->manager,
                'url' => $this->url
            ]);
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
            "member" => $this->username,
            "team" => $this->teamname
        ];
    }
}
