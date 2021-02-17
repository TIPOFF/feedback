<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Commands;

use Tipoff\Feedback\Mail\FeedbackSummary;
use Tipoff\Locations\Models\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendFeedbackSummaryEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:feedbacksummary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the daily summary emails of the new internal feedback we received';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Check if there is any new internal feedback or Google Reviews
        $locations = Location::where('corporate', 1)->get();
        foreach ($locations as $location) {
            Mail::send(new FeedbackSummary($location));
        }
    }
}
