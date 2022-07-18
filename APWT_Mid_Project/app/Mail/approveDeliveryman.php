<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class approveDeliveryman extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $sub;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub,$username)
    {
        $this->username = $username;
        $this->sub = $sub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.approveDeliveryman')
        ->with('username',$this->username)
        ->subject($this->sub);
    }
}
