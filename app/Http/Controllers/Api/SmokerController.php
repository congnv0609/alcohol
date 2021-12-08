<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\EmaTrait;
use App\Models\Ema1;
use App\Models\Ema2;
use App\Models\Ema3;
use App\Models\Ema4;
use App\Models\Ema5;
use App\Models\Incentive;
use App\Models\Smoker;
use App\Models\WakeTime;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\SendNotification;

class SmokerController extends Controller
{
    use EmaTrait;

    private $accountId;

    const PERIOD_TIME = 1;

    public function __construct()
    {
        $this->accountId = request()->header('accountId');
    }

    /**
     * Get schedule for an account
     * 
     * @header Content-Type application/json
     * @header Accept application/json
     * @header accountId integer
     * @authenticated
     */
    public function getSchedule()
    {
        $smoker = Smoker::where('id', $this->accountId)->first();
        if (empty($smoker)) {
            return response()->json($smoker, 404);
        }
        return response()->json($smoker, 200);
    }

    /**
     * Post schedule for an account
     * 
     * @header Content-Type application/json
     * @header Accept application/json
     * @header accountId integer
     * @authenticated
     * 
     * @bodyParam startDate string required YYYY-MM-DD
     * @bodyParam startTime string required hh:ii
     * @bodyParam notification integer default 1
     */
    public function postSchedule()
    {
        $data = $this->getParams();
        // DB::transaction(
        //     function () {
        $smoker = Smoker::where("id", $this->accountId)->first();
        if (empty($smoker)) {
            return response()->json($smoker, 404);
        }
        if (empty($data)) {
            return response()->json(['msg' => 'Nothing to update'], 200);
        }
        $smoker->startDate = $data["startDate"];
        $smoker->endDate = $data["endDate"];
        $smoker->save();
        $smokerData = $this->makeDateArray($data['startDate']);
        $this->createIncentive($smokerData);
        //create ema data 
        $ema_arr1 = $this->makeEmaArray($data['startDate'], 1);
        $ema_arr2 = $this->makeEmaArray($data['startDate'], 2);
        $ema_arr3 = $this->makeEmaArray($data['startDate'], 3);
        $ema_arr4 = $this->makeEmaArray($data['startDate'], 4);
        $ema_arr5 = $this->makeEmaArray($data['startDate'], 5);
        $this->createEma1($ema_arr1);
        $this->createEma2($ema_arr2);
        $this->createEma3($ema_arr3);
        $this->createEma4($ema_arr4);
        $this->createEma5($ema_arr5);
        Artisan::call('ema:schedule-get');
        Artisan::call('smoker:update-info');
        return response()->json($smoker, 200);
        //     }
        // );
        // return response()->json($data, 400);
    }

    /**
     * Update schedule for an account
     * 
     * @header Content-Type application/json
     * @header Accept application/json
     * @header accountId integer
     * @authenticated
     * 
     * @bodyParam startDate string required YYYY-MM-DD
     * @bodyParam startTime string required hh:ii
     * @bodyParam notification integer default 1
     */
    public function updateSchedule(Request $request)
    {
        $data = $this->getParams();
        // DB::transaction(
        //     function () {
        $smoker = Smoker::where('id', $this->accountId)->first();
        if (empty($smoker)) {
            return response()->json($smoker, 404);
        }
        if (empty($data)) {
            return response()->json(['msg' => 'Nothing to update'], 200);
        }
        $this->logChange($smoker, $data);
        $smoker->update($data);
        $smokerData = $this->makeDateArray($data['startDate']);
        $this->updateIncentive($smokerData);
        //create ema data 
        $ema_arr1 = $this->makeEmaArray($data['startDate'], 1);
        $ema_arr2 = $this->makeEmaArray($data['startDate'], 2);
        $ema_arr3 = $this->makeEmaArray($data['startDate'], 3);
        $ema_arr4 = $this->makeEmaArray($data['startDate'], 4);
        $ema_arr5 = $this->makeEmaArray($data['startDate'], 5);
        $this->updateEma1($ema_arr1);
        $this->updateEma2($ema_arr2);
        $this->updateEma3($ema_arr3);
        $this->updateEma4($ema_arr4);
        $this->updateEma5($ema_arr5);
        // Cache::forget('ema:schedule');
        Artisan::call('ema:schedule-get');
        Artisan::call('smoker:update-info');
        return response()->json($smoker, 200);
        //     }
        // );
        // return response()->json($data, 400);
    }

    private function logChange($old, $new)
    {
        $data = [
            'account_id' => $old->id,
            'data_of_change' => !empty($old->startDate) ? date_format($old->startDate, "Y-m-d") : null,
            'old_wake' => !empty($old->startDate) ? date_format($old->startDate, "H:i") : null,
            'new_wake' => date_format(date_create($new["startDate"]), "H:i"),
        ];
        $wakeLog = WakeTime::create($data);
    }

    private function getParams()
    {
        $data = [];
        $date = request()->input('startDate');
        $time = request()->input('startTime');
        $notification = request()->input('notification');
        $strDateTime = sprintf("%s %s", $date, $time);
        $strDateTime = date_create($strDateTime);
        $startDateTime = date_format($strDateTime, "Y-m-d H:i");
        $endTime = date_add($strDateTime, date_interval_create_from_date_string("7 days"));
        $endDateTime = date_format($endTime, "Y-m-d H:i");
        if (!empty($startDateTime)) {
            $data['startDate'] = $startDateTime;
        }
        if (!empty($endDateTime)) {
            $data['endDate'] = $endDateTime;
        }
        if (!empty($notification)) {
            $data['notification'] = $notification;
        }

        return $data;
    }

    private function makeDateArray($startDate)
    {
        $data = [];
        $dateString = date_create($startDate);
        for ($i = 0; $i < 7; $i++) {
            $record = [];
            $record['account_id'] = $this->accountId;
            $record['date'] = $i > 0 ? date_format(date_add($dateString, date_interval_create_from_date_string("1 days")), 'Y-m-d') : date_format($dateString, 'Y-m-d');
            $data[] = $record;
        }
        return $data;
    }

    private function makeEmaArray($startDate, $ema)
    {
        $data = [];
        for ($i = 0; $i < 7; $i++) {
            $record = [];
            $dateString = date_create($startDate);
            $record['account_id'] = $this->accountId;
            $record['date'] = date_format(date_add($dateString, date_interval_create_from_date_string("$i days")), 'Y-m-d');
            $record['nth_day'] = $i + 1;
            $record['submit_time'] = new DateTime();
            $period = $ema * self::PERIOD_TIME;
            switch ($ema) {
                case 1:
                    $record['popup_time'] = date_format($dateString, 'Y-m-d H:i:s');
                    $record['popup_time1'] = date_format(date_add($dateString, date_interval_create_from_date_string("$period hours")), 'Y-m-d H:i:s');
                    $record['popup_time2'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    break;
                case 2:
                    $record['popup_time'] = date_format(date_add($dateString, date_interval_create_from_date_string("$period hours")), 'Y-m-d H:i:s');
                    $record['popup_time1'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    $record['popup_time2'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    break;
                case 3:
                    $record['popup_time'] = date_format(date_add($dateString, date_interval_create_from_date_string("$period hours")), 'Y-m-d H:i:s');
                    $record['popup_time1'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    $record['popup_time2'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    break;
                case 4:
                    $record['popup_time'] = date_format(date_add($dateString, date_interval_create_from_date_string("$period hours")), 'Y-m-d H:i:s');
                    $record['popup_time1'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    $record['popup_time2'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    break;
                case 5:
                    $record['popup_time'] = date_format(date_add($dateString, date_interval_create_from_date_string("$period hours")), 'Y-m-d H:i:s');
                    $record['popup_time1'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    $record['popup_time2'] = date_format(date_add($dateString, date_interval_create_from_date_string("5 minutes")), 'Y-m-d H:i:s');
                    $record['date'] = date_format($dateString, 'Y-m-d');
                    // $record['date'] = $i > 0 ? date_format(date_add($dateString, date_interval_create_from_date_string("1 days")), 'Y-m-d') : date_format($dateString, 'Y-m-d');
                    break;
                default:
                    $record['popup_time'] = null;
            }

            $data[] = $record;
        }
        return $data;
    }

    private function createIncentive($data)
    {
        $first = Incentive::where('account_id', $this->accountId)->first();
        if (!empty($data) && empty($first)) {
            foreach ($data as $item) {
                Incentive::create($item);
            }
        }
    }

    private function updateIncentive($data)
    {
        if (!empty($data)) {
            $oldData = Incentive::where('account_id', $this->accountId)->get();
            foreach ($oldData as $key => $item) {
                $item->update($data[$key]);
            }
        }
    }

    private function createEma1($data)
    {
        $first = Ema1::where('account_id', $this->accountId)->first();
        if (!empty($data) && empty($first)) {
            foreach ($data as $item) {
                Ema1::create($item);
            }
        }
    }

    private function updateEma1($data)
    {
        $date = date_format(new DateTime(), 'Y-m-d');
        if (!empty($data)) {
            $oldData = Ema1::where('account_id', $this->accountId)->get();
            foreach ($oldData as $key => $item) {
                if($item->date > $date) {
                    $item->update($data[$key]);
                }
            }
        }
    }

    private function createEma2($data)
    {
        $first = Ema2::where('account_id', $this->accountId)->first();
        if (!empty($data) && empty($first)) {
            foreach ($data as $item) {
                Ema2::create($item);
            }
        }
    }

    private function updateEma2($data)
    {
        $date = date_format(new DateTime(), 'Y-m-d');
        if (!empty($data)) {
            $oldData = Ema2::where('account_id', $this->accountId)->get();
            foreach ($oldData as $key => $item) {
                if ($item->date > $date) {
                    $item->update($data[$key]);
                }
            }
        }
    }

    private function createEma3($data)
    {
        $first = Ema3::where('account_id', $this->accountId)->first();
        if (!empty($data) && empty($first)) {
            foreach ($data as $item) {
                Ema3::create($item);
            }
        }
    }

    private function updateEma3($data)
    {
        $date = date_format(new DateTime(), 'Y-m-d');
        if (!empty($data)) {
            $oldData = Ema3::where('account_id', $this->accountId)->get();
            foreach ($oldData as $key => $item) {
                if ($item->date > $date) {
                    $item->update($data[$key]);
                }
            }
        }
    }

    private function createEma4($data)
    {
        $first = Ema4::where('account_id', $this->accountId)->first();
        if (!empty($data) && empty($first)) {
            foreach ($data as $item) {
                Ema4::create($item);
            }
        }
    }

    private function updateEma4($data)
    {
        $date = date_format(new DateTime(), 'Y-m-d');
        if (!empty($data)) {
            $oldData = Ema4::where('account_id', $this->accountId)->get();
            foreach ($oldData as $key => $item) {
                if ($item->date > $date) {
                    $item->update($data[$key]);
                }
            }
        }
    }

    private function createEma5($data)
    {
        $first = Ema5::where('account_id', $this->accountId)->first();
        if (!empty($data) && empty($first)) {
            foreach ($data as $item) {
                Ema5::create($item);
            }
        }
    }

    private function updateEma5($data)
    {
        $date = date_format(new DateTime(), 'Y-m-d');
        if (!empty($data)) {
            $oldData = Ema5::where('account_id', $this->accountId)->get();
            foreach ($oldData as $key => $item) {
                if ($item->date > $date) {
                    $item->update($data[$key]);
                }
            }
        }
    }

    /**
     * Saving device token to push message
     * @authenticated
     * @header accountId integer required
     * @bodyParam token string required token use to push notification
     */
    public function saveDeviceToken(Request $request)
    {
        $smoker = Smoker::where('id', $this->accountId)->first();
        if(!empty($smoker)) {
            $smoker->update(['device_token' => $request->token]);
            return response()->json(['Token stored.']);
        }
        return response()->json(['msg'=>'User not found'], 404);
    }

    /**
     * test send notification
     * @authenticated
     * @header accountId integer required
     * @bodyParam title string required
     * @bodyParam body string required
     */
    public function sendNotification(Request $request)
    {
        $smoker = Smoker::whereNotNull('device_token')->where('id', $this->accountId)->first();
        if (empty($smoker)) {
            return response()->json(['msg' => 'User not found!'], 404);
        }
        $ema = $this->getNextSurvey($this->accountId);
        
        if(empty($ema)) {
            return response()->json(['msg' => 'Not found Ema'], 404);
        }
        SendNotification::dispatch($ema->toArray());
    }
}
