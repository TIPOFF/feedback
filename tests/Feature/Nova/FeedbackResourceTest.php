<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\TestSupport\Models\User;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Tests\TestCase;

class FeedbackResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        Feedback::factory()->count(4)->create();

        $this->actingAs(User::factory()->create());

        $response = $this->getJson('nova-api/feedbacks')
            ->assertOk();

        $this->assertCount(4, $response->json('resources'));
    }
}
