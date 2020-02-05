<?php

namespace App\Imports;

use App\Jk_al;
use Maatwebsite\Excel\Concerns\ToModel;

class Jk_alImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jk_al([
            'id_alternatif' => $row[0],
                'pria' => $row[1],
                'wanita' => $row[2],
        ]);
    }
}
