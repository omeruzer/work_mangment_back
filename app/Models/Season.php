<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $table ='seasons';
    protected $guarded = [];

    public function getProducts(){
        return $this->hasMany('App\Models\Product','season_id');
    }
}
