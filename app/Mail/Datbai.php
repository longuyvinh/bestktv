<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Datbai extends Mailable
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
        'phone' => $this->data->phone,
        'song' => $this->data->song,
        'singer' => $this->data->singer,
        'link' => $this->data->link
      );
      return $this->subject("Customer order custom sing on Best KTV")
                  ->with(['input' => $input])
                  ->from('admin@best-ktv.com', 'Admin Best KTV')
                  ->view('emails.datbat');
    }
}
