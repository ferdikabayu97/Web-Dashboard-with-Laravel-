<?php

namespace App\Exports;

use App\rek_harga;
use Maatwebsite\Excel\Concerns\FromCollection;

class Rek_hargaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return rek_harga::all();
    }
}
