<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorService extends Model
{
    protected $fillable = [
        'cost',
        'allowance',
        'staff_id'
    ];

    public function doctor(){
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
}
