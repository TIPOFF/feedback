<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Tipoff\Locations\Models\Location;

class FeedbackSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $location;

    /**
     * Create a new message instance.
     *
     * @param $location
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Also need to include the Google Reviews
        // Include positive/negative count in title
        return $this->markdown('feedback::emails.summary');
    }
}
