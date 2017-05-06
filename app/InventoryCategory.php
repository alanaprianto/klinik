<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    protected $fillable = [
        'name',
        'desc'
    ];

    public function inventories(){
        return $this->hasMany('App\Inventory');
    }
}
