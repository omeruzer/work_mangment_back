<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table ='materials';
    protected $guarded = [];

    public function getProducts(){
        return $this->hasMany('App\Models\Product','material_id');
    }
}
