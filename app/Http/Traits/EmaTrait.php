<?php

namespace App\Http\Traits;

use App\Models\Ema1;
use App\Models\Ema2;
use App\Models\Ema3;
use App\Models\Survey;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait EmaTrait
{

    public function getEmaSchedule()
    {
        $data = [];
        $data[] = $this->getEma1()->toArray();
        $data[] = $this->getEma2()->toArray();
        $data[] = $this->getEma3()->toArray();
        $data = Arr::collapse($data);
        return $data;
    }

    private function getEma1()
    {
        $data = [];
        $date = date_format(new DateTime(), 'Y-m-d');
        $data = Ema1::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')
            ->where('date', $date)
            ->where(function ($query) {
                $query->orWhere('completed', 8886)->orWhereNull('completed');
            })
            ->get();
        return $data;
    }

    private function getEma2()
    {
        $data = [];
        $date = date_format(new DateTime(), 'Y-m-d');
        $data = Ema2::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')
            ->where('date', $date)
            ->where(function ($query) {
                $query->orWhere('completed', 8886)->orWhereNull('completed');
            })
            ->get();
        return $data;
    }

    private function getEma3()
    {
        $data = [];
        $date = date_format(new DateTime(), 'Y-m-d');
        $time = date_format(new DateTime(), 'H:i:s');
        if ($time >= strtotime("00:00:00") && $time < strtotime("03:00:00")) {
            $date = date_sub(new DateTime(), date_interval_create_from_date_string("1 days"));
        }
        $data = Ema3::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')
            ->where('date', $date)
            ->where(function ($query) {
                $query->orWhere('completed', 8886)->orWhereNull('completed');
            })
            ->get();
        return $data;
    }

    private function getEma(int $id, array $data)
    {
        switch ($id) {
            case 1:
                $ema = Ema1::where(['account_id' => $data['account_id'], 'date' => $data['date']])->first();
                return $ema;
            case 2:
                $ema = Ema2::where(['account_id' => $data['account_id'], 'date' => $data['date']])->first();
                return $ema;
            case 3:
                $ema = Ema3::where(['account_id' => $data['account_id'], 'date' => $data['date']])->first();
                return $ema;
        }
        return null;
    }

    public function getEmaList(int $id, $accountId, $size)
    {
        switch ($id) {
            case 1:
                $ema = DB::table('smokers')->join('ema1s', 'ema1s.account_id', '=', 'smokers.id');
                if ($accountId > 0) {
                    $ema->where('smokers.account', 'like', "%" . $accountId . "%");
                }
                return $ema->paginate($size);
            case 2:
                $ema = DB::table('smokers')->join('ema2s', 'ema2s.account_id', '=', 'smokers.id');
                if ($accountId > 0) {
                    $ema->where('smokers.account', 'like', "%" . $accountId . "%");
                }
                return $ema->paginate($size);
            case 3:
                $ema = DB::table('smokers')->join('ema3s', 'ema3s.account_id', '=', 'smokers.id');
                if ($accountId > 0) {
                    $ema->where('smokers.account', 'like', "%" . $accountId . "%");
                }
                return $ema->paginate($size);
        }
        return null;
    }

    public function updateCountPush(&$data)
    {
        unset($data['current_ema'], $data['id']);
        $ema = $this->getEma($data['nth_ema'], $data);
        $ema->update($data);
    }

    public function getPopupInfo(array $data)
    {
        $end_time = date_add(new Datetime($data['popup_time']), date_interval_create_from_date_string("30 minutes"));
        $current_ema = (new DateTime() > new DateTime($data['popup_time']) && new DateTime() <= $end_time) ? 1 : 0;
        $data['nth_popup'] = (int)$data['nth_popup'] < 3 ? (int)$data['nth_popup'] + 1 : 3;
        $data['current_ema'] = $current_ema;
        return $data;
    }

    public function getPromptMessage($ema)
    {
        $nth_popup = $ema['nth_popup'];
        $nth_ema = $ema['nth_ema'];
        // $current_ema = $ema['current_ema'];
        switch ($nth_popup) {
            case 1: {
                    switch ($nth_ema) {
                        case 1: {
                                $title = "1st EMA (1st app push alert)";
                                $msg = "Alcohol 邀請你做今日第1次問卷, 請你在30分鐘內完成！";
                                break;
                            }
                        case 2: {
                                $title = "2nd EMA (1st app push alert)";
                                $msg = "Alcohol 邀請你做今日第2次問卷, 請你在30分鐘內完成！";
                                break;
                            }
                        default:
                            $title = "3rd EMA (1st app push alert)";
                            $msg = "Alcohol 邀請你做今日最後一次問卷, 請你在30分鐘內完成！";
                            break;
                    }
                    break;
                }
            case 2: {
                $title = "2nd app push alert";
                $msg = "最後15分鐘答題,  放棄填寫會損失是次現金禮券！";
                break;
            }
            case 3: {
                $title = "3rd app push alert";
                $msg = "最後5分鐘答題,  放棄填寫會損失是次現金禮券！";
                break;
            }
        }
        return ['title' => $title, 'body' => $msg];
    }

    public function getNextSurvey($accountId)
    {
        // $data = $this->getEmaSchedule();
        $data = [];

        // $date = date_format(date_sub(new DateTime(), date_interval_create_from_date_string("15 minutes")), 'Y-m-d H:i:s');

        $this->getEarliestEma1($accountId, $data);
        $this->getEarliestEma2($accountId, $data);
        $this->getEarliestEma3($accountId, $data);
        $next_survey = reset($data);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                // find earlieast ema
                if ($value->popup_time <= $next_survey->popup_time) {
                    $next_survey = $value;
                }
                //find current ema
                $end_time = date_add(new Datetime($next_survey->popup_time), date_interval_create_from_date_string("30 minutes"));
                $current_ema = (new DateTime() >= new DateTime($next_survey->popup_time) && new DateTime() <= $end_time) ? 1 : 0;
                //
                $next_survey->current_ema = $current_ema;
            }
            //current ema
            return $next_survey;
        }
        return null;
    }

    private function getEarliestEma1($accountId, &$data)
    {
        $date = date_format(date_sub(new DateTime(), date_interval_create_from_date_string("30 minutes")), 'Y-m-d H:i:s');
        $list = Ema1::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')
            ->where('account_id', $accountId)
            ->where('completed', '!=', true)
            ->orderby('date', 'asc')->get();
        if (!empty($list)) {
            foreach ($list as $ema) {
                $popup_time = date_format(new DateTime($ema->popup_time), 'Y-m-d H:i:s');
                if ($popup_time >= $date) {
                    $data[] = $ema;
                    return;
                }
            }
        }
        return;
    }

    private function getEarliestEma2($accountId, &$data)
    {
        $date = date_format(date_sub(new DateTime(), date_interval_create_from_date_string("30 minutes")), 'Y-m-d H:i:s');
        $list = Ema2::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')
            ->where('account_id', $accountId)
            ->where('completed', '!=', true)
            ->orderby('date', 'asc')->get();
        if (!empty($list)) {
            foreach ($list as $ema) {
                $popup_time = date_format(new DateTime($ema->popup_time), 'Y-m-d H:i:s');
                if ($popup_time >= $date) {
                    $data[] = $ema;
                    return;
                }
            }
        }
        return;
    }

    private function getEarliestEma3($accountId, &$data)
    {
        $date = date_format(date_sub(new DateTime(), date_interval_create_from_date_string("30 minutes")), 'Y-m-d H:i:s');
        $list = Ema3::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')
            ->where('account_id', $accountId)
            ->where('completed', '!=', true)
            ->orderby('date', 'asc')->get();
        if (!empty($list)) {
            foreach ($list as $ema) {
                $popup_time = date_format(new DateTime($ema->popup_time), 'Y-m-d H:i:s');
                if ($popup_time >= $date) {
                    $data[] = $ema;
                    return;
                }
            }
        }
        return;
    }

    private function getEma1ByCond($cond)
    {
        $data = [];
        if (empty($cond)) {
            return [];
        }
        $data = Ema1::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')->where($cond)->first();
        return $data;
    }

    private function getEma2ByCond($cond)
    {
        $data = [];
        if (empty($cond)) {
            return [];
        }
        $data = Ema2::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')->where($cond)->first();
        return $data;
    }

    private function getEma3ByCond($cond)
    {
        $data = [];
        if (empty($cond)) {
            return [];
        }
        $data = Ema3::select('id', 'account_id', 'date', 'nth_day', 'nth_ema', 'nth_popup', 'attempt_time', 'popup_time', 'popup_time1', 'popup_time2')->where($cond)->first();
        return $data;
    }

    public function getEmaByQuery($query)
    {
        switch ($query['nth_ema']) {
            case 1:
                return $this->getEma1ByCond($query);
            case 2:
                return $this->getEma2ByCond($query);
            case 3:
                return $this->getEma3ByCond($query);
        }
        return null;
    }

    public function makeSurvey(array $data)
    {
        $ret = [];
        for ($i = 0; $i < 21; $i++) {
            $record = [];
            $record['account_id'] = $data['account_id'];
            $record['account'] = $data['account'];
            $record['start_date'] = date_format(new DateTime($data['start_date']), 'Y-m-d');
            $record['end_date'] = date_format(new DateTime($data['end_date']), 'Y-m-d');
            $record['nth_day_current'] = $i + 1;
            $ret[] = $record;
        }

        return $ret;
    }

    public function saveSurvey($data)
    {
        $accountId = reset($data)['account_id'];
        if (!empty($accountId)) {
            $first = Survey::where('account_id', $accountId)->first();
        }
        if (!empty($data) && empty($first)) {
            foreach ($data as $item) {
                Survey::create($item);
            }
        }
    }
}
