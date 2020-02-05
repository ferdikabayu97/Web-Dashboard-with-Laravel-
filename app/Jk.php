<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jk extends Model
{
    protected $table = 'jk';
    protected $fillable = ['id_lokasi','pria','wanita'];
    public $timestamps = false;

    public function data_kode_lokasi() { 
        return $this->belongsTo('App\Data_kode_lokasi','id_lokasi','id_lokasi'); 
    }
}
