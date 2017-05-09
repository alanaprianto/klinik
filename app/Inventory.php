<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'explain',
        'sediaan',
        'price',
        'inventory_category_id'
    ];

    public function batches(){
        return $this->hasMany('App\Batch');
    }

    public function depos(){
        return $this->belongsToMany('App\Depo', 'inventories_depos', 'inventories_id', 'depos_id');
    }

    public function pictures(){
        return $this->hasMany('App\Picture');
    }

    public function inventoryCategory(){
        return $this->belongsTo('App\InventoryCategory', 'inventory_category_id', 'id');
    }

    public function tuslahs(){
        return $this->belongsToMany('App\Inventory', 'inventories_inventories', 'inventories_id' ,'tuslahs_id');
    }

    public function inventories(){
        return $this->belongsToMany('App\Inventory', 'inventories_inventories', 'tuslahs_id' ,'inventories_id');
    }

    public function services(){
        return $this->belongsToMany('App\Service', 'services_inventories', 'inventories_id' ,'services_id');
    }

    public function stock(){
        return $this->hasMany('App\Stock');
    }
}
