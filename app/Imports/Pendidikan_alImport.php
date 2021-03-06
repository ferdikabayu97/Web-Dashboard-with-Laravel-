<?php

namespace App\Imports;

use App\Pendidikan_al;
use Maatwebsite\Excel\Concerns\ToModel;

class Pendidikan_alImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pendidikan_al([
            'id_alternatif' => $row[0],
                'belum_sekolah' => $row[1],
                'belum_tamat_sd' => $row[2],
                'tamat_sd' => $row[3],
                'smp' => $row[4],
                'sma' => $row[5],
                'di_dii' => $row[6],
                'diii' => $row[7],
                's1' => $row[8],
                's2' => $row[9],
                's3' => $row[10],
        ]);
    }
}
