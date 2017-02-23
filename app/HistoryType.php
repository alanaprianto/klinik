<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryType extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];
    public function histories(){
        return $this->hasMany('App\History');
    }
}
