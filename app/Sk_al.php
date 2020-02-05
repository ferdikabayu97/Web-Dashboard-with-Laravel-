<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sk_al extends Model
{
    protected $table = 'sk_al';
    protected $fillable = ['id_alternatif','belum_kawin','kawin','cerai_hidup','cerai_mati'];
    public $timestamps = false;

    public function alternatif() { 
        return $this->belongsTo('App\Alternatif','id_alternatif','id_alternatif'); 
    }
}
