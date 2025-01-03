<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveActivityRegistered extends Mailable
{
    use Queueable, SerializesModels;

    protected $activity;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('TobankGo - Actividad registrada')
        ->markdown('emails.approve_activities.registered')
        ->with([
            'activity' => $this->activity,
        ]);
    }
}
