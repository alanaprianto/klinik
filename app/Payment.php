<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'type',
        'total',
        'status',
        'quantity',
        'register_id',
        'reference_id',
        'service_id',
        'inventory_id'
    ];
    public function reference(){
        return $this->belongsTo('App\Reference', 'reference_id', 'id');
    }

    public function service(){
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }

    public function inventory(){
        return $this->belongsTo('App\Inventory', 'inventory_id', 'id');
    }
}
