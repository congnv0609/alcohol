<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Traits\ReportTrait;
use App\Jobs\MakeReport;
use App\Models\Ema1;
use App\Models\Ema2;
use App\Models\Ema3;
use App\Models\Incentive;
use App\Models\Smoker;
use App\Models\Survey;
use App\Models\UploadPhoto;
use App\Models\WakeTime;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SmokerController extends Controller
{
    use ReportTrait;

    /**
     * Get schedule for an account
     * 
     * @header Content-Type application/json
     * @header Accept application/json
     * @header accountId integer
     * @authenticated
     * 
     */
    // public function getSchedule()
    // {
    //     $smoker = Smoker::where('id', $this->accountId)->first();

    //     return response()->json($smoker, 200);
    // }

    /**
     * Post schedule for an account
     * 
     * @header Content-Type application/json
     * @header Accept application/json
     * @authenticated
     * 
     * @bodyParam startDate string required YYYY-MM-DD
     * @bodyParam startTime string required hh:ii
     * @bodyParam notification integer default 1
     */
    // public function postSchedule()
    // {
    //     $data = $this->getParams();
    //     $smoker = Smoker::where('id', $this->accountId)->first();

    //     $smoker->update($data);
    //     return response()->json($smoker, 200);
    // }

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
        $data['startDate'] = $startDateTime;
        $data['endDate'] = $endDateTime;
        $data['notification'] = $notification;
        return $data;
    }

    /**
     * List of smokers
     * @authenticated
     * @queryParam page integer page number
     * @queryParam size integer number of row per page
     */
    public function list()
    {
        $size = request()->input('size');
        $query = request()->query();
        $account = $query['account']??null;
        $sort = explode(',', $query['sort']);

        // $list = Survey::where(function ($con) use ($account) {
        //     if(!empty($account)) {
        //         $con->where('account', 'like', $account);
        //     }
        // })
        // ->orderBy($sort[0], $sort[1])
        // ->orderBy('nth_day_current', 'asc')
        // ->paginate($size)->withQueryString();

        $list = DB::table('surveys')
                ->select(DB::raw('if(smokers.term > 1, concat(smokers.account,"-",smokers.term), smokers.account) as account'), 'smokers.status', 'surveys.*')
                ->join('smokers', 'smokers.id', '=', 'surveys.account_id');

        if ($account > 0) {
            $list->where('smokers.account', 'like', "%" . $account . "%");
        }
        $list = $list->orderBy('surveys.'.$sort[0], $sort[1])
            ->orderBy('surveys.nth_day_current', 'asc')
            ->paginate($size);

        return response()->json($list, 200);
    }

    /**
     * Detail of smoker
     * @authenticated
     */
    public function detail($id)
    {
        # code...
        $smoker = Smoker::find($id);
        return response()->json($smoker, 200);
    }

    /**
     * Update schedule for an account
     * 
     * @header Content-Type application/json
     * @header Accept application/json
     * @authenticated
     * 
     * @bodyParam startDate string required YYYY-MM-DD
     * @bodyParam startTime string required hh:ii
     * @bodyParam notification integer default 1
     */
    public function updateSchedule($id)
    {
        $smoker = Smoker::find($id);

        $date = request()->input('startDate');
        $time = request()->input('startTime');
        $strDateTime = sprintf("%s %s", $date, $time);
        $strDateTime = date_create($strDateTime);
        $startDateTime = date_format($strDateTime, "Y-m-d H:i");
        $endTime = date_add($strDateTime, date_interval_create_from_date_string("7 days"));
        $endDateTime = date_format($endTime, "Y-m-d H:i");
        $smoker->startDate = $startDateTime;
        $smoker->endDate = $endDateTime;
        $smoker->save();
        return response()->json($smoker, 200);
    }

    /**
     * Get overview personal description
     * 
     */
    public function overview($accountId){
        $data = [];
        $data = Cache::get("report:$accountId");
        if(empty($data)) {
            // MakeReport::dispatch($accountId);
            // $data = Cache::get("report:$accountId");
            $data = $this->getOverviewData($accountId);
            Cache::put("report:$accountId", $data, 3600 * 24);
            // return response()->json($data, 200);
        }
        if(!empty($data)) {
            return response()->json($data,200);
        }
        return response()->json($data, 404);
    }


    public function check()
    {
        $list = Survey::find(1)->smoker;

        return response()->json($list, 200);
    }

    /**
     * delete account personal description
     * 
     */
    public function delete($accountId)
    {
        DB::beginTransaction();
        try{
            $smoker = Smoker::find($accountId);
            if(empty($smoker)) {
                return response()->json(['msg'=>'Account not found'], 404);
            }
            Ema1::where('account_id', $accountId)->delete();
            Ema2::where('account_id', $accountId)->delete();
            Ema3::where('account_id', $accountId)->delete();
            Incentive::where('account_id', $accountId)->delete();
            //delete photo
            $photo = UploadPhoto::where('account_id', $accountId)->first();
            if(!empty($photo)) {
                Storage::deleteDirectory("upload/$photo->account");
                UploadPhoto::where('account_id', $accountId)->delete();
            }
            WakeTime::where('account_id', $accountId)->delete();
            Survey::where('account_id', $accountId)->delete();
            Smoker::destroy($accountId);
            DB::commit();
            return response()->json(['msg'=>'Deleted account'], 200);
        } catch(Exception $ex) {
            DB::rollback();
            return response()->json(['msg'=>$ex->getMessage()], 500);
        }
    }

}
