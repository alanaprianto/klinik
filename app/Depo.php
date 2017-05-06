<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    protected $fillable = [
        'amount',
        'total',
        'stock_minimal',
        'stock_maximal',
        'unit',
        'poly_id',
        'parent_id',
    ];

    public function poly(){
        return $this->belongsTo('App\Poly', 'poly_id', 'id');
    }

    public function inventories(){
        return $this->belongsToMany('App\Inventory', 'inventories_depos', 'depos_id', 'inventories_id');
    }

    public function parentDepo()
    {
        return $this->belongsTo('App\Depo', 'parent_id', 'id');
    }

    public function subDepos(){
        return $this->hasMany('App\Depo', 'parent_id');
    }


    public function depoTransactions(){
        return $this->belongsToMany('App\DepoTransaction', 'depo_transaction_id', 'id');
    }
}
