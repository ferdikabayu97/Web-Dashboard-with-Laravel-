<?php

namespace App\Imports;

use App\Jk;
use Maatwebsite\Excel\Concerns\ToModel;

class JkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jk([
            'id_lokasi' => $row[0],
                'pria' => $row[1],
                'wanita' => $row[2],
        ]);
    }
}
