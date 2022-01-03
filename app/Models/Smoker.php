<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Smoker extends Model
{
    use HasFactory, Notifiable;

    // protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'account',
        'term',
        'startDate',
        'endDate',
        'notification',
        'device_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        // 'remember_token',
    ];

    public function getAccountAttribute()
    {
        if ($this->term > 1) {
            return $this->attributes['account'] . "-" . $this->attributes['term'];
        } else {
            return $this->attributes['account'];
        }
    }

    protected $casts = [
        // 'account' => 'string',
        // 'startDate' => 'datetime',
        // 'endDate' => 'datetime',
    ];
}
