<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icd10 extends Model
{
    protected $fillable = [
        'code',
        'desc'
    ];
}
