<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Commands;

use Tipoff\Feedback\Mail\FeedbackRequest;
use Tipoff\Feedback\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendFeedbackRequestEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:feedbackrequest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to participants requesting feedback';

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
        // Will need to limit. Will also just want yesterday's participants.
        $today = Carbon::now('America/New_York')->format('Y-m-d');
        $feedbacks = Feedback::whereNull('emailed_at')
            ->where('date', '<', $today)
            ->orderByDesc('id')
            ->take(10)
            ->get();
        foreach ($feedbacks as $feedback) {
            Mail::send(new FeedbackRequest($feedback));

            // This is needed to prevent emailing twice. Can update later to the actual time the email was sent if need to be exact and confirm it was actually sent.
            $feedback->emailed_at = Carbon::now();
            $feedback->save();
        }
    }
}
