<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectCategory extends Model
{
    protected $fillable = [
        'name',
        'desc'
    ];


    public function objects(){
        return $this->belongsToMany('App\Object', 'objects_object_categories', 'objects_id' ,'object_categories_id');
    }
}
