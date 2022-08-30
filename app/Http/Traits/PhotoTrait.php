<?php

namespace App\Http\Traits;

use App\Models\UploadPhoto;
use DateTime;

trait PhotoTrait
{

    public function newPhoto($photo, $extension)
    {
        if (UploadPhoto::where([['account_id', $photo->account_id], ['date', $photo->date], ['photo_number', $photo->photo_number]])->exists()) {
            $photo->photo_number++;
            $date = date_format(new DateTime(), 'Ymd');
            $fileName = sprintf('%s_%8s_%2s_%4s_%s.%s', $photo->account, $date, $photo->survey_number, $photo->question_number, $photo->photo_number, $extension);
            $photo->photo_name = $fileName;
            $this->newPhoto($photo, $extension);
        } else {
            $date = date_format(new DateTime(), 'Ymd');
            $fileName = sprintf('%s_%8s_%2s_%4s_%s.%s', $photo->account, $date, $photo->survey_number, $photo->question_number, $photo->photo_number, $extension);
            $photo->photo_name = $fileName;
            $photo->save();
            return $photo;
        }
    }

    public function makeData($smoker){
        $account_id = request()->header('accountId');
        $surveyNo = request()->survey_number ?? '00';
        $questionNo = request()->question_number ?? "0000";
        $account = $smoker->term > 1 ? sprintf('%d-%d', $smoker->account, $smoker->term) : $smoker->account;
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
}
