<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPosition extends Model
{
    protected $fillable = [
        'name',
        'desc'
    ];
    public function staff(){
        return $this->hasOne('App\Staff');
    }
}
