<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPosition extends Model
{
    protected $fillable = [
        'name'
    ];
    public function staff(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
}
