<?php

declare(strict_types=1);

namespace Tipoff\Feedback;

use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Policies\FeedbackPolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class FeedbackServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Feedback::class => FeedbackPolicy::class,
            ])
            ->name('feedback')
            ->hasConfigFile();
    }
}
