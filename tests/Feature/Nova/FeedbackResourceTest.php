<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Tests\TestCase;

class FeedbackResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        Feedback::factory()->count(4)->create();

        $this->actingAs(self::createPermissionedUser('view feedbacks', true));

        $response = $this->getJson('nova-api/feedback')
            ->assertOk();

        $this->assertCount(4, $response->json('resources'));
    }
}
