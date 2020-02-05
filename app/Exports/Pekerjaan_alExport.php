<?php

namespace App\Exports;

use App\Pekerjaan_al;
use Maatwebsite\Excel\Concerns\FromCollection;

class Pekerjaan_alExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pekerjaan_al::all();
    }
}
