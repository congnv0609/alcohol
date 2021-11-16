<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\EmaTrait;
use App\Http\Traits\PopupTimeTrait;
use App\Models\Ema1;
use App\Models\Ema2;
use App\Models\Ema3;
use App\Models\Ema4;
use App\Models\Ema5;
use App\Models\Incentive;
use DateTime;
use Illuminate\Support\Facades\Artisan;

class EmaController extends Controller
{

    use PopupTimeTrait, EmaTrait;

    private $accountId;

    public function __construct()
    {
        $this->accountId = request()->header('accountId');
    }

    /**
     * Delay survey
     * emaId, postponded value
     * @authenticated
     * @header accountId integer required
     * @bodyParam postponded_1 integer 1,2,3
     * @bodyParam postponded_2 integer 1,2,3
     * @bodyParam postponded_3 integer 1,2,3
     * 
     */

     public function delay($emaId) {
        $data = [];
         $pp1 = request()->input('postponded_1');
         $pp2 = request()->input('postponded_2');
         $pp3 = request()->input('postponded_3');
         if(!empty($pp1)) {
            $data['postponded_1'] = $pp1;
         }
        if (!empty($pp2)) {
            $data['postponded_2'] = $pp2;
        }
        if (!empty($pp3)) {
            $data['postponded_3'] = $pp3;
        }
        $data['date'] = date_format(new DateTime(),'Y-m-d');
        $data['account_id'] = $this->accountId;
        $ema = $this->getEma($emaId, $data);
        $data['popup_time'] = $ema->popup_time;
        $this->updatePopupTime($data);
        $ema->update($data);
        return response()->json($ema, 200);
     }

    /**
     * update an EMA and date values, use form url encoded
     * id [1=EMA1, 2=EMA2, 3=EMA3, 4=EMA4, 5=EMA5]
     * @header accountId integer required
     * @bodyParam date YYYY-MM-DD required 
     * @bodyParam completed integer [1=completed, default 0 incompleted]
     * @bodyParam time_taken integer taken time to do survey, maximum 15mins
     * @authenticated
     * 
     */
    public function update($id)
    {
        $data = request()->all();
        $data['submit_time'] = new DateTime();
        $ema = $this->getEma($id, $data);
        if (empty($ema)) {
            return response()->json(['msg' => 'Ema not found'], 404);
        }
        $data['popup_time'] = $ema->popup_time;
        $this->updatePopupTime($data);
        $ema->update($data);
        // Cache::forget('ema:schedule');
        Artisan::call('ema:get-schedule');
        $this->updateIncentive($id, $data);
        return response()->json($ema, 200);
    }

    /**
     * set Attempt Time
     * id [1=EMA1, 2=EMA2, 3=EMA3, 4=EMA4, 5=EMA5]
     * @header accountId integer required
     * @bodyParam date YYYY-MM-DD required 
     * @authenticated
     * 
     */
    public function setAttemptTime($id)
    {
        $data['date'] = request()->input('date');
        $data['attempt_time'] = new DateTime();
        $data['account_id'] = $this->accountId;
        $ema = $this->getEma($id, $data);
        if (!empty($ema)) {
            $ema->update($data);
        }
        return response()->json($ema, 200);
    }

    /**
     * get next survey
     * @header accountId integer required
     * @authenticated
     */
    public function getSurvey()
    {
        $currentEma = $this->getPopupTime($this->accountId);
        if (empty($currentEma)) {
            return response()->json(['msg' => 'Not found next survey time'], 404);
        }
        return response()->json(['survey_time' => date_format(new Datetime($currentEma->popup_time), 'Y-m-d H:i:s'), 'current_ema' => $currentEma->current_ema, 'ema' => $currentEma->ema, 'popup_time' => $currentEma->popup_time, 'nth_day' => $currentEma->nth_day, 'postponded_1' => $currentEma->postponded_1, 'postponded_2' => $currentEma->postponded_2, 'postponded_3' => $currentEma->postponded_3], 200);
    }

    private function updateIncentive(int $emaId, array $data)
    {
        $ret = [];
        $data['completed'] = !empty($data['completed']) ? $data['completed'] : 0;
        $incentive = Incentive::where(['account_id' => $this->accountId, 'date' => $data['date']])->first();
        $ema = "ema_$emaId";
        $incentive->{$ema} = $data["completed"];
        $incentive->valid_ema = $incentive->ema_1 + $incentive->ema_2 + $incentive->ema_3 + $incentive->ema_4 + $incentive->ema_5;
        $incentive->incentive = $incentive->valid_ema * 5;
        return $incentive->save();
    }

    private function getMinuteDelay($postponded)
    {
        switch($postponded) {
            case 1: return 5;
            case 2: return 30;
            default: return 0;
        }
        // if ($postponded) {
        //     return 30;
        // } elseif ($postponded) {
        //     return 15;
        // } elseif ($postponded) {
        //     return 5;
        // }
        // return 0;
    }

    private function updatePopupTime(&$data)
    {
        if (isset($data['postponded_1'])) {
            $delayMinutes = $this->getMinuteDelay($data['postponded_1']);
            if ($delayMinutes > 0) {
                $data['popup_time'] = date_format(date_add(date_create($data['popup_time']), date_interval_create_from_date_string("$delayMinutes minutes")), 'Y-m-d H:i:s');
            }
        }
        if (isset($data['postponded_2'])) {
            $delayMinutes = $this->getMinuteDelay($data['postponded_2']);
            if ($delayMinutes > 0) {
                $data['popup_time'] = date_format(date_add(date_create($data['popup_time']), date_interval_create_from_date_string("$delayMinutes minutes")), 'Y-m-d H:i:s');
            }
        }
        if (isset($data['postponded_3'])) {
            $delayMinutes = $this->getMinuteDelay($data['postponded_3']);
            if ($delayMinutes > 0) {
                $data['popup_time'] = date_format(date_add(date_create($data['popup_time']), date_interval_create_from_date_string("$delayMinutes minutes")), 'Y-m-d H:i:s');
            }
        }
    }
}
