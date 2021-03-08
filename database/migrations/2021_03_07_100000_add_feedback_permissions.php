<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddFeedbackPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view feedback',
            'create feedback',
            'update feedback'
        ];

        $this->createPermissions($permissions);
    }
}
