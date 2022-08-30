<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Jobs\GenerateImage;
use App\Models\Smoker;
use App\Models\UploadPhoto;
use DateTime;

class UploadController extends Controller
{
    use PhotoTrait;

    const LARGE_SIZE = 1024;
    const MEDIUM_SIZE = 512;
    const SMALL_SIZE = 256;


    /** 
     * Upload photo
     * @authenticated
     * @header accountId integer required
     * @bodyParam survey_number(default 00)
     * @bodyParam question_number(default 0000)
     * 
     */
    
    public function upload(){
        $this->validate(request(), [
            'photos' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if (request()->hasFile('photos')) {
            $account_id = request()->header('accountId');
            $smoker = Smoker::find($account_id);
            if(empty($smoker)){
                return response()->json(['msg: User not found'],404);
            }
            $extension = request()->photos->extension();
            $account = $smoker->term > 1? sprintf('%d-%d',$smoker->account, $smoker->term):$smoker->account;
            $path = sprintf('upload/%s/original', $account);

            $photo = $this->makeData($smoker);
            $this->newPhoto($photo, $extension);

            // $fileName = sprintf('%s_%8s_%2s_%4s_%s.%s', $account, $date, $surveyNo, $questionNo, $photo->photo_number, $extension);
            $path = request()->photos->storeAs($path, $photo->photo_name);
            if (request()->file('photos')->isValid()) {
                //generate photo size
                // $pathForLargeImage = sprintf('upload/%s/large', $account);
                // $pathForMediumImage = sprintf('upload/%s/medium', $account);
                // $pathForSmallImage = sprintf('upload/%s/small', $account);
                //get original path
                // $path = asset($path);
                // GenerateImage::dispatch($path, $account, self::LARGE_SIZE);
                // GenerateImage::dispatch($path, $pathForMediumImage, 512);
                // GenerateImage::dispatch($path, $pathForSmallImage);
                
            }
            return response()->json(['msg'=>'Upload success', 'path'=>$path], 200);
            // dd($extension);
        }
    }
}
