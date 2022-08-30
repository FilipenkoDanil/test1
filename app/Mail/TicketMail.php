<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->ticket->file) {
            return $this->view('mail.ticket')->with([
                'ticket' => $this->ticket
            ])->attachFromStorageDisk('public', $this->ticket->file);
        } else {
            return $this->view('mail.ticket')->with([
                'ticket' => $this->ticket
            ]);
        }
    }
}
