<?php

namespace App\Exports;

use App\Umur_al;
use Maatwebsite\Excel\Concerns\FromCollection;

class Umur_alExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Umur_al::all();
    }
}
