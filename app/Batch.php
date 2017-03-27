<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'code',
        'name',
        'expired_date',
        'inventory_id',
        'sum',
        'stock'
    ];

    public function inventory(){
        return $this->belongsTo('App\Inventory', 'inventory_id', 'id');
    }

    public function setExpiredDateAttribute($value){
        if ($value) {
            $this->attributes['expired_date'] = Carbon::createFromFormat('d/m/Y', $value);
        }
    }
}
