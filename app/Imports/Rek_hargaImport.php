<?php

namespace App\Imports;

use App\rek_harga;
use Maatwebsite\Excel\Concerns\ToModel;

class Rek_hargaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new rek_harga([
            'id_rharga' => $row[0],
                'h5_10' => $row[1],
                'h10_15' => $row[2],
                'h15_20' => $row[3],
                'h20_25' => $row[4],
                'h25_30' => $row[5],
                'h30_abv' => $row[6],
        ]);
    }
}
