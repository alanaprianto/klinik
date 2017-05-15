<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'desc'
    ];

    public function services(){
        return $this->hasMany('App\Service');
    }
}
