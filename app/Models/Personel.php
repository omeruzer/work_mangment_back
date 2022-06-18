<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personel extends Model
{
    use HasFactory;

    protected $table ='personels';
    protected $guarded = [];

    public function getDepartman(){
        return $this->hasOne('App\Models\Departman','id','departman_id');
    }
}
