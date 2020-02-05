<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_Edit extends Model
{
    protected $table = 'log_edit';
    
    protected $fillable = ['idx_table','id_admin','log','tabel','event','kunci'];
}
