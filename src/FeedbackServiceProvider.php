<?php

declare(strict_types=1);

namespace Tipoff\Feedback;

use Tipoff\Feedback\Commands\PullOpens;
use Tipoff\Feedback\Commands\SendFeedbackRequestEmails;
use Tipoff\Feedback\Commands\SendFeedbackSummaryEmails;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Feedback\Policies\FeedbackPolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class FeedbackServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        /** @psalm-suppress UndefinedMethod **/
        $package
            ->hasPolicies([
                Feedback::class => FeedbackPolicy::class,
            ])
            ->hasCommands([
                SendFeedbackRequestEmails::class,
                SendFeedbackSummaryEmails::class,
                PullOpens::class,
            ])
            ->hasNovaResources([
                \Tipoff\Feedback\Nova\Feedback::class,
            ])
            ->name('feedback')
            ->hasViews()
            ->hasConfigFile();
    }
}
