<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WakeTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'date_of_change',
        'old_wake',
        'new_wake',
    ];
}
