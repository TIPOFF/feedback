<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Unit\Mail;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tipoff\Authorization\Models\User;
use Tipoff\Feedback\Mail\FeedbackSummary;
use Tipoff\Feedback\Tests\TestCase;
use Tipoff\Locations\Models\Location;

class FeedbackSummaryTest extends TestCase
{
    use DatabaseTransactions;

    //Todo: Need to figure out how to test markdown content

    /** @test */
    public function email()
    {
        $this->actingAs(User::factory()->create());
        Mail::fake();
        Mail::assertNothingSent();

        Mail::to('test@example.com')->send(new FeedbackSummary(Location::factory()->create()));
        Mail::assertSent(FeedbackSummary::class);
    }
}
