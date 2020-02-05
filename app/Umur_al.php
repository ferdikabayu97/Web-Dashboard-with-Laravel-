<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Umur_al extends Model
{
    protected $table = 'umur_al';
    protected $fillable = ['id_alternatif','u0_4','u5_9','u10_14','u15_19','u20_24','u25_29','u30_34','u35_39','u40_44','u45_49','u50_54','u55_59','u60_64','u65_69','u70_74','u75_above'];
    public $timestamps = false;

    public function alternatif() { 
        return $this->belongsTo('App\Alternatif','id_alternatif','id_alternatif'); 
    }
}
