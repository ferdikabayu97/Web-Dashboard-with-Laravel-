<?php

namespace App\Imports;

use App\Pekerjaan;
use Maatwebsite\Excel\Concerns\ToModel;

class PekerjaanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pekerjaan([
            'id_lokasi' => $row[0],
                'tidak_bekerja' => $row[1],
                'aparat_pejabat_negara' => $row[2],
                'tenaga_pengajar' => $row[3],
                'wiraswasta' => $row[4],
                'pertanian' => $row[5],
                'nelayan' => $row[6],
                'bidang_keagamaan' => $row[7],
                'pelajar_dan_mahasiswa' => $row[8],
                'tenaga_kesehatan' => $row[9],
                'pensiunan' => $row[10],
                'lainnya' => $row[11],
        ]);
    }
}
