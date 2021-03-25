<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Tests\TestCase;
use Tipoff\Authorization\Models\User;

class FeedbackResourceTest extends TestCase
{
    use DatabaseTransactions;


    private const NOVA_ROUTE = 'nova-api/feedback';

    /**
     * @dataProvider dataProviderForIndexByRole
     * @test
     */
    public function index_by_role(?string $role, bool $hasAccess, bool $canIndex)
    {
        $user = User::factory()->create();
        if ($role) {
            $user->assignRole($role);
        }
        $this->actingAs($user);

        Feedback::factory()->count(4)->create();

        $response = $this->getJson(self::NOVA_ROUTE)
            ->assertStatus($hasAccess ? 200 : 403);

        if ($hasAccess) {
            $this->assertCount($canIndex ? 4 : 0, $response->json('resources'));
        }
    }

    public function dataProviderForIndexByRole()
    {
        return [
            'Admin' => ['Admin', true, true],
            'Owner' => ['Owner', true, true],
            'Executive' => ['Executive', true, true],
            'Staff' => ['Staff', true, true],
            'Former Staff' => ['Former Staff', false, false],
            'Customer' => ['Customer', false, false],
            'No Role' => [null, false, false],
        ];
    }
}
