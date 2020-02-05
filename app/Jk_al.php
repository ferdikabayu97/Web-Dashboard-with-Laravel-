<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jk_al extends Model
{
    protected $table = 'jk_al';
    protected $fillable = ['id_alternatif','pria','wanita'];
    public $timestamps = false;

    public function alternatif() { 
        return $this->belongsTo('App\Alternatif','id_alternatif','id_alternatif'); 
    }
}
