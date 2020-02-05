<?php

namespace App\Exports;

use App\Alternatif;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlternatifExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alternatif::all();
    }
}
