<?php

namespace App\Imports;

use App\Data_kode_lokasi;
use Maatwebsite\Excel\Concerns\ToModel;

class Data_kode_lokasiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Data_kode_lokasi([
            'id_lokasi' => $row[0],
                'kecamatan' => $row[1],
                'kelurahan' => $row[2],
                'banyak_penduduk' => $row[3],
                'idx_table' => $row[4],
        ]);
    }
}
