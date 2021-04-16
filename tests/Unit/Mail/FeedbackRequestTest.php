<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Unit\Mail;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tipoff\Feedback\Mail\FeedbackRequest;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Tests\TestCase;

class FeedbackRequestTest extends TestCase
{
    use DatabaseTransactions;

    //Todo: Need to figure out how to test markdown content

    /** @test */
    public function email()
    {
        Mail::fake();
        Mail::assertNothingSent();

        $feedback = Feedback::factory()->create();
        Mail::send(new FeedbackRequest($feedback));
        Mail::assertSent(function (FeedbackRequest $mail) use ($feedback) {
            $mail->build();

            return $mail->feedback->id === $feedback->id &&
                $mail->hasFrom($feedback->location->email->email, $feedback->location->title) &&
                //Todo: require Bookings
                $mail->hasTo($feedback->participant->email->email) &&
                $mail->hasBcc('digitalmgr@thegreatescaperoom.com');
        });
    }
}
