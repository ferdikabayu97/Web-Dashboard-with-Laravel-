<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_id extends Model
{
    protected $table = 'user_id';

    protected $fillable = ['id_user','nama','password','token','email','idx_table','active_status','verification','updated_at','created_at'];
}
