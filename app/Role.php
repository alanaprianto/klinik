<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
}
