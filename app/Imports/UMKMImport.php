<?php

namespace App\Imports;

use App\UMKM;
use Maatwebsite\Excel\Concerns\ToModel;

class UMKMImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UMKM([
            'no' => $row[0],
            'nama_perusahaan' => $row[1],
            'nama_pemilik'=> $row[2],
            'alamat'=> $row[3],
            'telp'=> $row[4],
            'jenis_usaha'=> $row[5],
            'jumlah'=> $row[6],
            'aset' => $row[7],
            'omset'=> $row[8],
            'kelurahan'=> $row[9],
            'kecamatan'=> $row[10],
            'tahun'=> $row[11],
            'ket'=> $row[12],
            'idx_table' => $row[13],
        ]);
    }
}
