<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Mail;

use Tipoff\Feedback\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;

    /**
     * Create a new message instance.
     *
     * @param Feedback $feedback
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $feedback = $this->feedback;
        $negative = url('/feedback/response?token=' . $feedback->token . '&rating=negative');
        $seminegative = url('/feedback/response?token=' . $feedback->token . '&rating=seminegative');
        $semipositive = url('/feedback/response?token=' . $feedback->token . '&rating=semipositive');
        $positive = url('/feedback/response?token=' . $feedback->token . '&rating=positive');

        $this->withSwiftMessage(function ($message) use ($feedback) {
            $message->feedback = $feedback;
            $message->getHeaders()->addTextHeader('tag', 'feedback');
        });

        return $this->markdown('feedback::emails.request')
            ->from($feedback->location->contact_email, $feedback->location->title)
            ->to($feedback->participant->email)
            ->bcc('digitalmgr@thegreatescaperoom.com')
            ->subject('How was your experience on ' . Carbon::parse($feedback->date)->format('M j') . '?')
            ->with([
                'name' => $feedback->participant->name,
                'negative' => $negative,
                'seminegative' => $seminegative,
                'semipositive' => $semipositive,
                'positive' => $positive,
            ]);
    }
}
