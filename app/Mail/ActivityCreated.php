<?php

namespace App\Mail;

use App\Models\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivityCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The activity instance.
     *
     * @var Activity
     */
    public $activity;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Activity $activity)
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
        return $this->subject('TobankGo - Nueva actividad')
                    ->markdown('emails.activities.created');
    }
}
