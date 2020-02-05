<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan_al extends Model
{
    protected $table = 'pendidikan_al';
    protected $fillable = ['id_alternatif','belum_sekolah','belum_tamat_sd','tamat_sd','smp','sma','di_dii','diii','s1','s2','s3'];
    public $timestamps = false;

    public function alternatif() { 
        return $this->belongsTo('App\Alternatif','id_alternatif','id_alternatif'); 
    }
    
}
