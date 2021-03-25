<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Unit\Policies;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Tests\TestCase;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Authorization\Models\User;

class FeedbackPolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        $user = self::createPermissionedUser('view feedbacks', true);
        $this->assertTrue($user->can('viewAny', Feedback::class));

        $user = self::createPermissionedUser('view feedbacks', false);
        $this->assertFalse($user->can('viewAny', Feedback::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {

        $this->actingAs(User::factory()->create());

        $feedback = Feedback::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $feedback));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => [ 'view', self::createPermissionedUser('view feedbacks', true), true ],
            'view-false' => [ 'view', self::createPermissionedUser('view feedbacks', false), false ],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $this->actingAs(User::factory()->create());
        $feedback = Feedback::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $feedback));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
