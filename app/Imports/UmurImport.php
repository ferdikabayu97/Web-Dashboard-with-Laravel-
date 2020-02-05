<?php

namespace App\Imports;

use App\Umur;
use Maatwebsite\Excel\Concerns\ToModel;

class UmurImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Umur([
            'id_lokasi' => $row[0],
                'u0_4' => $row[1],
                'u5_9' => $row[2],
                'u10_14' => $row[3],
                'u15_19' => $row[4],
                'u20_24' => $row[5],
                'u25_29' => $row[6],
                'u30_34' => $row[7],
                'u35_39' => $row[8],
                'u40_44' => $row[9],
                'u45_49' => $row[10],
                'u50_54' => $row[11],
                'u55_59' => $row[12],
                'u60_64' => $row[13],
                'u65_69' => $row[14],
                'u70_74' => $row[15],
                'u75_above' => $row[16]
        ]);
    }
}
