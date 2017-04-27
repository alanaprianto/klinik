<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    protected $fillable = [
        'poly_id',
        'inventory_id',
        'parent_id',
        'amount',
        'total',
        'stock_minimal',
        'stock_maximal',
        'unit',
    ];

    public function poly(){
        return $this->belongsTo('App\Poly', 'poly_id', 'id');
    }

    public function inventories(){
        return $this->belongsToMany('App\Inventory', 'inventories_depos', 'depos_id', 'inventories_id');
    }

    public function parentDepo()
    {
        return $this->belongsTo('App\Depo', 'parent_id');
    }

    public function subDepo(){
        return $this->hasMany('App\Depo', 'parent_id');
    }
}
