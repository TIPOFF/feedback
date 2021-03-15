<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddFeedbackPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view feedback' => ['Owner', 'Executive', 'Staff']
        ];

        $this->createPermissions($permissions);
    }
}
