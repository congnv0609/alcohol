<?php

namespace App\Console\Commands;

use App\Models\Incentive;
use App\Models\Survey;
use DateTime;
use Illuminate\Console\Command;

class UpdateSmokerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smoker:update-info {account_id : account id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update smoker information';

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
        $account_id = $this->argument('account_id');
        $date = date_format(new DateTime(), 'Y-m-d');
        //update survey data
        $userList = Survey::whereDate('start_date', '<=', $date)->whereDate('end_date', '>=', $date)->where('account_id', $account_id)->orderBy('nth_day_current', 'desc')->get();
        if (!empty($userList)) {
            foreach ($userList as $key => $value) {
                // $ema = Ema1::where([['date', $date], ['account_id', $value->id]])->first();
                $incentive = Incentive::where([['no_of_date', $value->nth_day_current], ['account_id', $value->account_id]])->first();
                $incentive_total = Incentive::where([['account_id', $value->account_id], ['incentive', '>=', '15']])->sum('incentive');
                // if(!empty($ema)) {
                //     $value->nth_day_current = $ema->nth_day;
                // }
                if(!empty($incentive)) {
                    $value->ema_completed_nth_day = $incentive->valid_ema??0;
                    $value->incentive_nth_day = $incentive->incentive >= 15 ? $incentive->incentive : 0;
                }
                $value->incentive_total = (int)$incentive_total;
                $value->updated_at = new DateTime();
                $value->save();
            }
        }
        
    }
}
