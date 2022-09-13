<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadPhoto extends Model
{
    use HasFactory;

    protected $appends = ['small_url', 'medium_url', 'large_url'];

    public function getSmallUrlAttribute()
    {
        return "/upload/{$this->account}/small/{$this->photo_name}";
    }

    public function getMediumUrlAttribute()
    {
        return "/upload/{$this->account}/medium/{$this->photo_name}";
    }

    public function getLargeUrlAttribute()
    {
        return "/upload/{$this->account}/large/{$this->photo_name}";
    }
}
