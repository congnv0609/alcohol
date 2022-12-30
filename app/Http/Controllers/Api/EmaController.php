<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\EmaTrait;
use App\Jobs\MakeReport;
use App\Models\Incentive;
use App\Models\Smoker;
use DateTime;
use Illuminate\Support\Facades\Artisan;

class EmaController extends Controller
{

    use EmaTrait;

    private $accountId;

    public function __construct()
    {
        $this->accountId = request()->header('accountId');
    }

    /**
     * update an EMA and date values, use form url encoded
     * id [1=EMA1, 2=EMA2, 3=EMA3]
     * @header accountId integer required
     * @bodyParam date YYYY-MM-DD required 
     * @bodyParam completed integer [1=completed, default 8886 incompleted]
     * @bodyParam time_taken integer taken time to do survey, maximum 15mins
     * @bodyParam true/false values should be 1/0
     * @authenticated
     * 
     */
    public function update($id)
    {
        $data = request()->all();
        if(!isset($data['1st_reminder']) && !isset($data['2nd_reminder']) && !isset($data['3rd_reminder'])) {
            $data['submit_time'] = new DateTime();
        }
        $data['account_id'] = $this->accountId;
        $ema = $this->getEma($id, $data);
        if (empty($ema)) {
            return response()->json(['msg' => 'Ema not found'], 404);
        }
        $ema->update($data);
        Artisan::call('ema:schedule-get');
        $this->updateIncentive($id, $data);
        Artisan::call('smoker:update-info', ['account_id'=>$this->accountId]);
        Artisan::call('smoker:report', ['account_id'=>$this->accountId]);
        //MakeReport::dispatch($this->accountId);
        return response()->json($ema, 200);
    }

    /**
     * set Attempt Time
     * id [1=EMA1, 2=EMA2, 3=EMA3]
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
            Artisan::call('ema:schedule-get');
            return response()->json($ema, 200);
        }
        return response()->json(['msg' => 'Ema not found'], 404);
    }

    /**
     * get next survey
     * @header accountId integer required
     * @authenticated
     */
    public function getSurvey()
    {
        $smoker = Smoker::find($this->accountId);
        if (empty($smoker)) {
            return response()->json($smoker, 404);
        }

        $currentEma = $this->getNextSurvey($this->accountId);
        if (empty($currentEma)) {
            return response()->json([], 200);
        }
        return response()->json([
            'survey_time' => date_format(new Datetime($currentEma['popup_time']), 'Y-m-d H:i:s'), 
            'date' => $currentEma['date'],
            'current_ema' => $currentEma['current_ema'], 
            'ema' => $currentEma['nth_ema'], 
            'popup_time' => date_format(new Datetime($currentEma['popup_time']), 'Y-m-d H:i:s'), 
            'popup_time1' => date_format(new Datetime($currentEma['popup_time1']), 'Y-m-d H:i:s'), 
            'popup_time2' => date_format(new Datetime($currentEma['popup_time2']), 'Y-m-d H:i:s'), 
            'nth_day' => $currentEma['nth_day'], 
            'nth_popup' => $currentEma['nth_popup']
        ], 200);
    }

    private function updateIncentive(int $emaId, array $data)
    {
        $data['completed'] = !empty($data['completed']) ? $data['completed'] : 0;
        $incentive = Incentive::where(['account_id' => $this->accountId, 'date' => $data['date']])->first();
        $ema = "ema_$emaId";
        $incentive->{$ema} = $data["completed"];
        $incentive->valid_ema = $incentive->ema_1 + $incentive->ema_2 + $incentive->ema_3;
        $incentive->incentive = $incentive->valid_ema * 5;
        $incentive->complaince_rate = $incentive->valid_ema/63*100;
        $incentive->additional_incentive = $incentive->complaince_rate>=85?100:0;
        $incentive->total_incentive = $incentive->incentive + $incentive->additional_incentive;
        return $incentive->save();
    }

    /**
     * Check ema validate time
     * @header accountId integer required
     * @authenticated
     * @queryParam nth_ema integer required
     * @queryParam nth_day integer required
     * 
     */
    public function checkValidEma()
    {
        $nth_ema = request()->query('nth_ema');
        $nth_day = request()->query('nth_day');
        $accountId = $this->accountId;
        $query = [
            'nth_ema' => $nth_ema,
            'nth_day' => $nth_day,
            'account_id' => $accountId,
        ];
        $ema = $this->getEmaByQuery($query);
        if (!empty($ema)) {
            $valid = 0;
            $end_time = date_format(date_add(new Datetime($ema->popup_time), date_interval_create_from_date_string("30 minutes")), 'Y-m-d H:i:s');
            if (new DateTime($ema->popup_time) <= new DateTime() && new DateTime() <= new DateTime($end_time)) {
                $valid = 1;
            }
            return response()->json(['current_ema' => $valid], 200);
        }
        return response()->json(['msg' => 'Ema not found'], 200);
    }
}
