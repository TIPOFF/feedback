<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests\Support\Providers;

use Tipoff\Feedback\Models\Feedback;
use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        Feedback::class,
    ];
}
