<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'pendidikan';

    protected $fillable = ['id_lokasi','belum_sekolah','belum_tamat_sd','tamat_sd','smp','sma','di_dii','diii','s1','s2','s3'];
    public $timestamps = false;

    public function data_kode_lokasi() { 
        return $this->belongsTo('App\Data_kode_lokasi','id_lokasi','id_lokasi'); 
    }

}
