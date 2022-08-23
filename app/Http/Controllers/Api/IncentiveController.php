<?php

namespace App\Http\Controllers\Api;

use App\Models\Incentive;
use App\Http\Controllers\Controller;
use App\Models\Ema1;
use App\Models\Ema2;
use App\Models\Ema3;
use DateTime;
use Illuminate\Support\Arr;

class IncentiveController extends Controller
{
    private $accountId;

    public function __construct()
    {
        $this->accountId = request()->header('accountId');
    }

    /**
     * Finished survey
     * @authenticated
     * @header accountId integer required
     * 
     */
    public function finished(){
        $data = [];
        // $data = Incentive::select('date','valid_ema', 'updated_at')->where('account_id', $this->accountId)->get();
        $ema1 = Ema1::select('account_id', 'date', 'nth_day', 'nth_ema', 'submit_time', 'completed')->where([['completed', true],['account_id', $this->accountId]])->get();
        $ema2 = Ema2::select('account_id', 'date', 'nth_day', 'nth_ema', 'submit_time', 'completed')->where([['completed', true],['account_id', $this->accountId]])->get();
        $ema3 = Ema3::select('account_id', 'date', 'nth_day', 'nth_ema', 'submit_time', 'completed')->where([['completed', true],['account_id', $this->accountId]])->get();
        if(!empty($ema1)) {
            $data[]=$ema1->toArray();
        }
        if (!empty($ema2)) {
            $data[] = $ema2->toArray();
        }
        if (!empty($ema3)) {
            $data[] = $ema3->toArray();
        }
        $data = Arr::collapse($data);
        $data = collect($data)->sortBy('nth_day')->toArray();
        $data = array_values($data);
        return response()->json($data, 200);
    }

    /**
     * Progress
     * @authenticated
     * @header accountId integer required
     * 
     */
    public function progress()
    {
        # code...
        $date = date_format(new DateTime(), 'Y-m-d');
        $count = Incentive::selectRaw('count(1) as passed_days')->where([['account_id', $this->accountId],['date', '<=', $date]])->first();
        return response()->json($count, 200);
    }

}
