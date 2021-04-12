<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Tests;

use DrewRoberts\Blog\BlogServiceProvider;
use Laravel\Nova\NovaCoreServiceProvider;
use Livewire\LivewireServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Bookings\BookingsServiceProvider;
use Tipoff\Feedback\FeedbackServiceProvider;
use Tipoff\Feedback\Tests\Support\Providers\NovaPackageServiceProvider;
use Tipoff\Locations\LocationsServiceProvider;
use Tipoff\Seo\SeoServiceProvider;
use Tipoff\Statuses\StatusesServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
            SupportServiceProvider::class,
            LivewireServiceProvider::class,
            AuthorizationServiceProvider::class,
            PermissionServiceProvider::class,
            AddressesServiceProvider::class,
            LocationsServiceProvider::class,
            SeoServiceProvider::class,
            BlogServiceProvider::class,
            StatusesServiceProvider::class,
            BookingsServiceProvider::class,
            FeedbackServiceProvider::class,
        ];
    }
}
