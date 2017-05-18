<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];


    public function objectCategories(){
        return $this->belongsToMany('App\ObjectCategory', 'objects_object_categories', 'object_categories_id', 'objects_id');
    }

    public function objectGalleries(){
        return $this->hasMany('App\ObjectGallery');
    }

    public function objectPrices(){
        return $this->hasMany('App\ObjectPrice');
    }

    public function objectTransactions(){
        return $this->hasMany('App\ObjectTransaction');
    }

    public function objectDescriptions(){
        return $this->hasMany('App\ObjectDescription');
    }
}
