<?php

namespace Tipoff\Feedback;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Feedback\Commands\FeedbackCommand;

class FeedbackServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('feedback')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_feedback_table')
            ->hasCommand(FeedbackCommand::class);
    }
}
