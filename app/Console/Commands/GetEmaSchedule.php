<?php

namespace App\Console\Commands;

use App\Http\Traits\EmaTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GetEmaSchedule extends Command
{
    use EmaTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ema:schedule-get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting all ema need to push notification';

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
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $data = [];
        $data = $this->getEmaSchedule();
        if(!empty($data)) {
            // Cache::forget('ema:schedule');
            Cache::put('alcohol:schedule', $data, 3600 * 24);
        }
    }

}
