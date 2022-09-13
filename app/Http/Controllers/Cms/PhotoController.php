<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\UploadPhoto;
use Illuminate\Http\Request;

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
}
