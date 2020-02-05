<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan_al extends Model
{
    protected $table = 'pekerjaan_al';

    protected $fillable = ['id_alternatif','tidak_bekerja','aparat_pejabat_negara','tenaga_pengajar','wiraswasta','pertanian','nelayan','bidang_keagamaan','pelajar_dan_mahasiswa','tenaga_kesehatan','pensiunan','lainnya'];
    public $timestamps = false;


    public function alternatif() { 
        return $this->belongsTo('App\Alternatif','id_alternatif','id_alternatif'); 
    }
}
