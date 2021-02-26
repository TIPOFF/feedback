<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Commands;

use Tipoff\Feedback\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PullOpens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:opens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull opens on feedback request emails and save opened_at time';

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
        $response = Http::withHeaders([
            'X-Postmark-Server-Token' => config('feedback.post-mark-token'),
            'Accept' => 'application/json',
        ])->get('https://api.postmarkapp.com/messages/outbound/opens?tag=feedback&count=500&offset=0');
        $data = $response->json();
        foreach ($data['Opens'] as $open) {
            $feedback = Feedback::where('email_identifier', $open['MessageID'])->first();
            if (isset($feedback)) {
                $feedback->opened_at = Carbon::parse($open['ReceivedAt']);
                $feedback->save();
            }
        }
    }
}
