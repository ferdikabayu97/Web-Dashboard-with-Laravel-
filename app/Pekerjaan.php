<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';

    protected $fillable = ['id_lokasi','tidak_bekerja','aparat_pejabat_negara','tenaga_pengajar','wiraswasta','pertanian','nelayan','bidang_keagamaan','pelajar_dan_mahasiswa','tenaga_kesehatan','pensiunan','lainnya'];
    public $timestamps = false;

    public function data_kode_lokasi() { 
        return $this->belongsTo('App\Data_kode_lokasi','id_lokasi','id_lokasi'); 
    }
}
