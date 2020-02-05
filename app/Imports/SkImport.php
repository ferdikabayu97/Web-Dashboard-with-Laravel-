<?php

namespace App\Imports;

use App\Sk;
use Maatwebsite\Excel\Concerns\ToModel;

class SkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sk([
                'id_lokasi' => $row[0],
                'belum_kawin' => $row[1],
                'kawin' => $row[2],
                'cerai_hidup' => $row[3],
                'cerai_mati' => $row[4],
        ]);
    }
}
