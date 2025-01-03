<?php

namespace App\Mail;

use App\Models\Deposit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DepositCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The activity instance.
     *
     * @var Deposit
     */
    public $deposit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Deposit $deposit)
    {
        $this->deposit = $deposit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('TobankGo - Deposito recibido')
                    ->markdown('emails.deposits.created');
    }
}
