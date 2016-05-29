<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Resources\Views\Email\User_notification;

class SendUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
        $author = $event->author->name;
        $email = $event->author->email;
        Mail::send('email.notification', ['name' => $author], function($message) use ($email, $author)
        {
            $message->from('admin@pulluri.com', 'Admin');
            $message->to($email, $author);
            $message->subject('Thanks for the Quote');
            
        });
    }
}
