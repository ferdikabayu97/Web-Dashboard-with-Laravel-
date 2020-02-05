<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    protected $table = 'UMKM';

    protected $fillable = ['no','nama_perusahaan','nama_pemilik','alamat','telp','jenis_usaha','jumlah','aset','omset','kelurahan','kecamatan','tahun','ket','idx_table'];
    public $timestamps = false;
}
