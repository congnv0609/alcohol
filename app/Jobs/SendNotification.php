<?php

namespace App\Jobs;

use App\Http\Traits\EmaTrait;
use App\Models\Smoker;
use App\Notifications\EmaPrompt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, EmaTrait;

    private $_ema = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $ema)
    {
        $this->_ema = $ema;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = Smoker::whereNotNull('device_token')->where('id', $this->_ema['account_id'])->first();
        if (!empty($user)) {
            $user->notify(new EmaPrompt($this->_ema, $user));
            UpdateSmokerReport::dispatch($user);
        }
    }
}
