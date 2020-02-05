<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rek_harga extends Model
{
    protected $table = 'rek_harga';
    protected $fillable = ['id_rharga','h5_10','h10_15','h15_20','h20_25','h25_30','h30_abv'];
    public $timestamps = false;

    public function alternatif() { 
        return $this->hasOne('App\Alternatif','id_rharga','id_rharga'); 
    }
}
