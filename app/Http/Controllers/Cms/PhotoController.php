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
        $fileName = $query['photo_name'] ?? '%';
        $list = UploadPhoto::where([
            ['account', 'like', $account],
            ['photo_name', 'like', '%'.$fileName.'%'],
        ])
        ->orderBy('updated_at', 'desc')
        ->paginate($size)->withQueryString();
        return response()->json($list, 200);
    }

    public function download() {

        // $imageList = request()->collect('array_id');
        // $listPhotos = UploadPhoto::whereIn('id', $imageList)->get();
        $listPhotos = UploadPhoto::all();

        if(empty($listPhotos)) {
            return response()->json(['msg'=>'No any file to download', 404]);
        }

        $zip = new ZipArchive;

        $path = public_path('download');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
            exec("chmod -R 775 " . $path);
            exec("chown -R www-data:www-data " . $path);
        }   
        $fileName = 'download-photos.zip';

        if ($zip->open(public_path("download/".$fileName), ZipArchive::CREATE)) {
            // $files = File::files(public_path('upload/12345/small'));
            $files = $this->getFilePath($listPhotos);

            foreach ($files as $key => $value) {
                if(file_exists($value)) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                
            }
        }
        $zip->close();
        // ob_clean();

        // $headers = array('Content-Type: application/octet-stream', 'Content-Length: ' . filesize($fileName));
        return response()->download(public_path("download/".$fileName))->deleteFileAfterSend(true);
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
