<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'code',
        'name',
        'category',
        'type',
        'total',
        'stock_minimal',
        'stock_maximal',
        'explain',
        'unit',
        'sediaan'
    ];

    public function batches(){
        return $this->hasMany('App\Batch');
    }

}
