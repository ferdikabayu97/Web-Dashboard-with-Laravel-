<?php

namespace App\Exports;

use App\Data_kode_lokasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class Data_kode_lokasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Data_kode_lokasi::all();
    }
}
