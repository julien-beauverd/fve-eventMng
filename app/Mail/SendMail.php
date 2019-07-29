<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * create the mail
     * @param String $eventName
     * @param String $mailType
     * @param String $title
     * @param String $subject
     * @param String $message
     * @param String $link
     * @return void
     */
    public function __construct(String $eventName, String $subject, String $message, String $link, String $mailType, String $title)
    {
        $this->eventName = $eventName;
        $this->subject = $subject;
        $this->message = $message;
        $this->link = $link;
        $this->mailType = $mailType;
        $this->title = $title;
    }

    /**
     * build the mail
     * test if the mail is specific or for all the members
     * @return Mail $this 
     */
    public function build()
    {
        if ($this->mailType == 'specific') {
            return $this->from('evenements-fve@map-pre-prod.ch', 'événements!')
                ->subject($this->subject)
                ->markdown('vendor.notifications.specific')
                ->with([
                    'title' => $this->title,
                    'message' => $this->message,
                    'link' => $this->link,
                    'eventName' => $this->eventName
                ]);
        } else {
            return $this->from('evenements-fve@map-pre-prod.ch', 'événements!')
                ->subject($this->subject)
                ->markdown('vendor.notifications.allmembers')
                ->with([
                    'message' => $this->message,
                    'link' => $this->link,
                    'title' => $this->title
                ]);
        }
    }
}
