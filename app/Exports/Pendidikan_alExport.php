<?php

namespace App\Exports;

use App\Pendidikan_al;
use Maatwebsite\Excel\Concerns\FromCollection;

class Pendidikan_alExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pendidikan_al::all();
    }
}
