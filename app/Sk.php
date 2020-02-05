<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    protected $table = 'sk';
    protected $fillable = ['id_lokasi','belum_kawin','kawin','cerai_hidup','cerai_mati'];
    public $timestamps = false;

    public function data_kode_lokasi() { 
        return $this->belongsTo('App\Data_kode_lokasi','id_lokasi','id_lokasi'); 
    }
}
