<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'name',
        'location',
        'desc',
        'inventory_id'
    ];

    public function inventory(){
        return $this->belongsTo('App\Inventory', 'inventory_id', 'id');
    }
}
