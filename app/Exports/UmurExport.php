<?php

namespace App\Exports;

use App\Umur;
use Maatwebsite\Excel\Concerns\FromCollection;

class UmurExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Umur::all();
    }
}
