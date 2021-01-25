<?php

namespace Tipoff\Feedback\Commands;

use Illuminate\Console\Command;

class FeedbackCommand extends Command
{
    public $signature = 'feedback';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
