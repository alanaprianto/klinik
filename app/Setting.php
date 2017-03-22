<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'name_value',
    ];

    public function getNameValueAttribute($value)
    {
        return json_decode($value, true);
    }
}
