<?php

namespace App\Console\Commands;

use App\Message;
use Illuminate\Console\Command;

class SendMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending messages that are in the queue';

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
     * @return mixed
     */
    public function handle()
    {
        $i = 0;
        while (true) {
            // Every sixty iteration destroy deleted records
            if ($i > 60) {
                $i = 0;
                Message::onlyTrashed()->forceDelete();
            }

            // Search next in line message
            $message = Message::withoutTrashed()
                ->orderBy('attempt', 'asc')
                ->orderBy('updated_at', 'asc')
                ->orderBy('created_at', 'asc')
                ->first();

            if ($message) {
                if ($message->send()) {
                    $message->delete();
                } else {
                    $message->increment('attempt');
                }
            }

            sleep(1);
            $i++;
        }
    }
}
