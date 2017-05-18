<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectGallery extends Model
{
    protected $fillable = [
        'name',
        'decs',
        'location',
        'icon',
        'object_id'
    ];

    public function object(){
        return $this->belongsTo('App\Object', 'object_id', 'id');
    }
}
