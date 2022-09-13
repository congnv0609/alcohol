<?php

namespace App\Console\Commands;

use App\Models\Ema1;
use App\Models\Ema2;
use App\Models\Ema3;
use App\Models\Ema4;
use App\Models\Ema5;
use App\Models\Smoker;
use Illuminate\Console\Command;

class ReportUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smoker:report {account_id : account id}';

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
        
        $account_id = $this->argument('account_id');
        $smoker = Smoker::find($account_id);
        $data = $this->UpdateSmoker($smoker->id);
        if (!empty($data)) {
            $smoker->prompt_ema = $data['prompt_ema'];
            $smoker->response_ema = $data['response_ema'];
            $smoker->non_response_ema = $data['non_response_ema'];
            $smoker->future_ema = $data['future_ema'];
            $smoker->response_rate = $data['response_rate'];
            $smoker->save();
        }

        return 0;
    }

    public function UpdateSmoker($accountId)
    {
        $data = [];
        $data['prompt_ema'] = $this->countEmaByPrompt($accountId);
        $data['response_ema'] = $this->countEmaByCompleted($accountId);
        $data['non_response_ema'] = ($data['prompt_ema'] - $data['response_ema']) > 0 ? $data['prompt_ema'] - $data['response_ema']: 0;
        $data['future_ema'] = 35 - $data['prompt_ema'];
        $data['response_rate'] = $data['prompt_ema'] > 0 ? $data['response_ema'] / $data['prompt_ema'] : 0;
        return $data;
    }

    public function countEmaByPrompt($accountId)
    {
        $count = 0;
        $count += Ema1::where([['nth_popup', '>', 0], ['account_id', $accountId]])->count();
        $count += Ema2::where([['nth_popup', '>', 0], ['account_id', $accountId]])->count();
        $count += Ema3::where([['nth_popup', '>', 0], ['account_id', $accountId]])->count();
        return $count;
    }

    public function countEmaByCompleted($accountId)
    {
        $count = 0;
        $count += Ema1::where([['completed', true], ['account_id', $accountId]])->count();
        $count += Ema2::where([['completed', true], ['account_id', $accountId]])->count();
        $count += Ema3::where([['completed', true], ['account_id', $accountId]])->count();
        return $count;
    }
}
