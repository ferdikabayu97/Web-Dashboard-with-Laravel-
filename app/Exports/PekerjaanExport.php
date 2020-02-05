<?php

namespace App\Exports;

use App\Pekerjaan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PekerjaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pekerjaan::all();
    }
}
