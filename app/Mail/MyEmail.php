<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $datais;

    public function __construct($datais, $data)
    {
        $this->data = $datais;
         $datais['type'];

        if ($datais['type'] == 'P') {
            $this->type = 'mail.partners';
            $this->subject = 'New Partner Details';
        } elseif ($datais['type'] == 'A') {
            $this->type = 'mail.affiliates';
            $this->subject = 'New Affiliates Details';
        }elseif ($datais['type'] == 'R') {
            $this->type = 'mail.returns';
            $this->subject = 'New Returns Details';
        }elseif ($datais['type'] == 'C') {
            $this->type = 'mail.contact';
            $this->subject = 'New Contact Details';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->type)
        ->subject($this->subject)
        ->with([
            'data' => $this->data
        ]);
    }
}
