<?php

namespace Tipoff\Feedback;

use Illuminate\Support\Str;
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
            ->hasMigration('2020_05_11_130000_create_feedbacks_table')
            ->hasCommand(FeedbackCommand::class);
    }

    /**
     * Using packageBooted lifecycle hooks to override the migration file name.
     * We want to keep the old filename for now.
     */
    public function packageBooted()
    {
        foreach ($this->package->migrationFileNames as $migrationFileName) {
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    $this->package->basePath("/../database/migrations/{$migrationFileName}.php.stub") => database_path('migrations/' . Str::finish($migrationFileName, '.php')),
                ], "{$this->package->name}-migrations");
            }
        }
    }
}
