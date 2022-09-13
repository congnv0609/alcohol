<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Traits\EmaTrait;
use Illuminate\Support\Facades\Cache;

class CheckEma extends Command
{
    use EmaTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ema:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // return 0;
        $accountId = $this->ask('What is your account ID?');
        // $data = $this->getEmaSchedule();
        $data = Cache::get('alcohol:schedule');
        $ret = [];
        foreach($data as $value) {
            if($value['account_id'] == $accountId) {
                $ret[]=$value;
            }
        }
        dd($ret);
    }
}
