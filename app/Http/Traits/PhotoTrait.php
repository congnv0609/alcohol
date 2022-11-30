<?php

namespace App\Http\Traits;

use App\Models\UploadPhoto;
use DateTime;

trait PhotoTrait
{

    public function newPhoto($photo, $index, $extension)
    {
        if (UploadPhoto::where([['account_id', $photo->account_id], ['date', $photo->date], ['photo_number', $photo->photo_number]])->exists()) {
            $photo->photo_number++;
            $date = date_format(new DateTime(), 'Ymd');
            if(empty($photo->question_number)) {
                $index = 0;
            }
            $question_number = sprintf("%02d%02d", $photo->question_number, $index);
            $fileName = sprintf('%s_%8s_%02d_%d_%d.%s', $photo->account, $date, $photo->survey_number, $question_number, $photo->photo_number, $extension);
            $photo->photo_name = $fileName;
            $this->newPhoto($photo, $index, $extension);
        } else {
            $date = date_format(new DateTime(), 'Ymd');
            if (empty($photo->question_number)) {
                $index = 0;
            }
            $question_number = sprintf("%02d%02d", $photo->question_number, $index);
            $fileName = sprintf('%s_%8s_%02d_%04d_%d.%s', $photo->account, $date, $photo->survey_number, $question_number, $photo->photo_number, $extension);
            $photo->photo_name = $fileName;
            $photo->save();
            return $photo;
        }
    }

    public function makeData($smoker){
        $account_id = request()->header('accountId');
        $surveyNo = request()->survey_number ?? '00';
        $questionNo = request()->question_number ?? 0;
        $account = $smoker->term > 0 ? sprintf('%d-%d', $smoker->account, $smoker->term) : $smoker->account;
        $photo = new UploadPhoto();
        $photo->account_id = $account_id;
        $photo->account = (string)$account;
        $photo->date = date_format(new DateTime(), 'Y-m-d');
        $photo->survey_number = $surveyNo;
        $photo->question_number = $questionNo;
        $photo_number = UploadPhoto::where([['account_id', $account_id], ['date', $photo->date]])->max('photo_number');
        $photo->photo_number = $photo_number + 1;
        return $photo;
    }

    public function deleteAccountPhoto($accountId)
    {
        # code...
    }

}
