<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveActivityApproved extends Mailable
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
        return $this->subject('TobankGo - Actividad aprobada')
            ->markdown('emails.approve_activities.approved')
            ->with([
                'activity' => $this->activity,
            ]);
    }
}
