<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\UploadPhoto;
use Illuminate\Http\Request;
use ZipArchive;
use File;

class PhotoController extends Controller
{
    //

    public function index()
    {
        $list = [];
        $size = request()->input('size');
        $query = request()->query();
        $account = $query['account'] ?? '%';
        $fileName = $query['file_name'] ?? '%';
        $list = UploadPhoto::where([
            ['account', 'like', $account],
            ['photo_name', 'like', $fileName],
        ])
        ->orderBy('updated_at', 'desc')
        ->paginate($size)->withQueryString();
        return response()->json($list, 200);
    }

    public function download() {
        
        $imageList = request()->collect('array_id');
        $listPhotos = UploadPhoto::whereIn('id', $imageList)->get();

        $zip = new ZipArchive;

        $path = public_path('download');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }   

        $fileName = 'download/download-photos.zip';

        if ($zip->open(public_path($fileName), ZipArchive::CREATE | ZIPARCHIVE::OVERWRITE)) {

            // $files = File::files(public_path('upload/12345/small'));
            $files = $this->getFilePath($listPhotos);

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
            
        }

        return response()->download(public_path($fileName));
    }

    private function getFilePath($listFiles, $size='original') {
        $arrayFilePath = [];
        foreach($listFiles as $value) {
            $item = sprintf("upload/%s/%s/%s", $value->account, $size, $value->photo_name);
            $arrayFilePath[] = $item;
        }
        return $arrayFilePath;
    }
}
