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
use Intervention\Image\Facades\Image;

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
        $size = 'small';
        switch($this->_size) {
            case 1024: $size = 'large'; break;
            case 512: $size = 'medium'; break;
            default: $size = 'small'; break;
        }
        return sprintf('upload/%s/%s', $this->_account, $size);
    }

    private function resize_image($path, $w, $h, $crop = FALSE)
    {
        // $path = storage_path()."/$file";
        list($width, $height, $type) = getimagesize(public_path($path));
        $imgName = basename($path);
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
        Storage::makeDirectory($pathToStorage);
        // File::ensureDirectoryExists(storage_path($pathToStorage));
        // chown(storage_path($pathToStorage), "apache");
        // chgrp(storage_path($pathToStorage), "apache");
        // exec('chown -R apache:apache '. storage_path($pathToStorage));
        $img = Image::make(public_path($this->_path))->resize($newwidth, $newheight, function($constraint){
            $constraint->aspectRatio();
        })->save(storage_path('app/'.$pathToStorage . '/' . $imgName));
    }
}
