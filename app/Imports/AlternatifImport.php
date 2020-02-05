<?php

namespace App\Imports;

use App\Alternatif;
use Maatwebsite\Excel\Concerns\ToModel;

class AlternatifImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alternatif([
            'id_alternatif' => $row[0],
    'nama_alternatif' => $row[1],
    'banyak_sample' => $row[2],
    'idx_table' => $row[3],
    'id_rharga' => $row[4],
        ]);
    }
}
