<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Unit\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Authorization\Models\User;
use Tipoff\Bookings\Models\Participant;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Tests\TestCase;
use Tipoff\Locations\Models\Location;
use Tipoff\Support\Contracts\Waivers\SignatureInterface;

class FeedbackModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $this->actingAs(User::factory()->create());
        $model = Feedback::factory()->create();
        $this->assertNotNull($model);
    }

    /** @test */
    public function create_from_signature()
    {
        $participant = Participant::factory()->create();
        $location = Location::factory()->create();

        $signature = \Mockery::mock(SignatureInterface::class);
        $signature->shouldReceive('getParticipant')->andReturn($participant);
        $signature->shouldReceive('getLocation')->andReturn($location);
        $signature->shouldReceive('getSignatureDate')->andReturn(Carbon::now());

        $feedback = Feedback::createFromSignature($signature);
        $this->assertNotNull($feedback);
    }
}
