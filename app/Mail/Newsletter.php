<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;
    private $newsletter;
    /**
     * Create a new message instance.
     *
     * @param $newsletter
     */
    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('newsletter::emails.news')
            ->with('newsletter', $this->newsletter)
            ->subject(trans('newsletter::front.subject', ['id' => $this->newsletter->id]));
    }
}
