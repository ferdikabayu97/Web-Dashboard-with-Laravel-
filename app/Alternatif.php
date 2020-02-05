<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatif';
    protected $fillable = ['id_alternatif','nama_alternatif','banyak_sample','idx_table','id_rharga'];
    public $timestamps = false;

    protected $guarded = ['id_alternatif'];

    public function jk_al() { 
        return $this->hasOne('App\Jk_al','id_alternatif','id_alternatif'); 
    }
    
    public function pekerjaan_al() { 
        return $this->hasOne('App\Pekerjaan_al','id_alternatif','id_alternatif'); 
    }
    
    public function pendidikan_al() { 
        return $this->hasOne('App\Pendidikan_al','id_alternatif','id_alternatif'); 
    }
    
    public function sk_al() { 
        return $this->hasOne('App\Sk_al','id_alternatif','id_alternatif'); 
    }
    
    public function umur_al() { 
        return $this->hasOne('App\Umur_al','id_alternatif','id_alternatif'); 
    }

    public function rek_harga() { 
        return $this->belongsTo('App\rek_harga','id_rharga','id_rharga'); 
    }

}
