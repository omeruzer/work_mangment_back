<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;

    protected $table ='patterns';
    protected $guarded = [];

    public function getProducts(){
        return $this->hasMany('App\Models\Product','pattern_id');
    }
}
