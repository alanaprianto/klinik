<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kiosk extends Model
{
    protected $fillable = [
        'queue_number',
        'date',
        'status',
        'type',
        'locket'
    ];
}
