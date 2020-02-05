<?php

namespace App\Imports;

use App\Sk_al;
use Maatwebsite\Excel\Concerns\ToModel;

class Sk_alImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sk_al([
            'id_alternatif' => $row[0],
                'belum_kawin' => $row[1],
                'kawin' => $row[2],
                'cerai_hidup' => $row[3],
                'cerai_mati' => $row[4],
        ]);
    }
}
