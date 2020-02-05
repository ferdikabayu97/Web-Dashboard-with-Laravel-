<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data_kode_lokasi extends Model
{
    protected $table = 'data_kode_lokasi';
    public $timestamps = false;
   
    protected $fillable = ['id_lokasi','kecamatan','kelurahan','banyak_penduduk','idx_table'];

public function jk() { 
    
    return $this->hasOne('App\Jk','id_lokasi','id_lokasi'); 
}

public function pekerjaan() { 
    return $this->hasOne('App\Pekerjaan','id_lokasi','id_lokasi'); 
}

public function pendidikan() { 
    return $this->hasOne('App\Pendidikan','id_lokasi','id_lokasi'); 
}

public function sk() { 
    return $this->hasOne('App\Sk','id_lokasi','id_lokasi'); 
}

public function umur() { 
    return $this->hasOne('App\Umur','id_lokasi','id_lokasi'); 
}

}
