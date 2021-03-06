<?php

namespace App\Mail;

use App\Office;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OfficeDeniedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $office;
    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Office $office)
    {
       $this->office = $office;
       $this->user = $office->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('الاعتذار عن موافقة الجهة')
                    ->markdown('emails.email_office_denied');
    }
}
