<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $input = array(
          'name' => $this->data->fullname,
          'email' => $this->data->email,
          'sub' => $this->data->subject,
          'mess' => $this->data->message
        );
        return $this->subject("Customer contact with you on Best KTV")
                    ->with(['input' => $input])
                    ->from('admin@best-ktv.com')
                    ->view('emails.contact');
    }
}
