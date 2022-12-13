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
     * @bodyParam photos[] file required array photo
     * @bodyParam survey_number(default 00)
     * @bodyParam question_number(2 number) and no of ad(2 number) (default 0000)
     * 
     * 
     */
    
    public function upload(){
        // $this->validate(request(), [
        //     'photos' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        // ]);
        if (request()->hasFile('photos')) {
            $account_id = request()->header('accountId');
            $smoker = Smoker::find($account_id);
            if(empty($smoker)){
                return response()->json(['msg: User not found'],404);
            }
            $account = $smoker->term > 0? sprintf('%05d-%d',$smoker->account, $smoker->term):$smoker->account;
            $folder = sprintf('upload/%s/original', $account);
            //upload files
            $photos = request()->file('photos');
            $arrayPath = [];
            foreach ($photos as $key => $photo) {
                //photos data
                $extension = $photo->extension();
                $photo = $this->makeData($smoker);
                $this->newPhoto($photo, $key+1, $extension);
                $path = request()->file('photos')[$key]->storeAs($folder, $photo->photo_name);
                $arrayPath[] = $path;
                if (request()->file('photos')[$key]->isValid()) {
                    //generate multi photo size
                    GenerateImage::dispatch($path, $account, self::LARGE_SIZE);
                    GenerateImage::dispatch($path, $account, self::MEDIUM_SIZE);
                    GenerateImage::dispatch($path, $account);
                }
            }
            
            return response()->json(['msg'=>'Uploaded successfully', 'path'=> $arrayPath], 200);
            // dd($extension);
        }
        return response()->json(['msg'=>'No any file to upload'], 400);
    }
}
