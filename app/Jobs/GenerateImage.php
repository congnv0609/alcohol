<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GenerateImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $_path;

    private $_account;

    private $_size;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path, $account, $size = 256)
    {
        //
        $this->_path = $path;
        $this->_account = $account;
        $this->_size = $size;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // list($width, $height, $type, $attr) = getimagesize($this->_path);
        $this->resize_image($this->_path, $this->_size, $this->_size);
    }

    private function buildPathToStorage(){
        return sprintf('upload/%s/%s', $this->_account, $this->_size);
    }

    private function resize_image($path, $w, $h, $crop = FALSE)
    {
        // $path = storage_path()."/$file";
        list($width, $height, $type) = getimagesize($path);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }

        $pathToStorage = $this->buildPathToStorage();

        $img = Image::make($this->_path)->resize($newwidth, $newheight, function($constraint){
            $constraint->aspectRatio();
        })->save($pathToStorage.'/'.$this->_path);

        // switch ($type) {
        //     case 2:
        //         $src = imagecreatefromjpeg($file);
        //         $imgResized = imagescale($src, $newwidth, $newheight);
        //         // Storage::put($this->_newPath.'/'.$imgResized);
        //         $fullPath = storage_path().'/'.$this->_newPath;
        //         // imagejpeg($imgResized, $fullPath);
        //         Storage::put($this->_newPath, File::get($file));
        //         break;
        //     case 3:
        //         $src = imagecreatefrompng($file);
        //         $imgResized = imagescale($src, $newwidth, $newheight);
        //         // Storage::put($this->_newPath . '/' . $imgResized);
        //         // imagepng($imgResized, 'path_of_Image/Name_of_Image_resized.png');
        //         break;
        // }

        // $imgResized = imagescale($src, $newwidth, $newheight);

        // $src = imagecreatefromjpeg($file);
        // $dst = imagecreatetruecolor($newwidth, $newheight);
        // imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // return $dst;
    }
}
