<?php

namespace App\Exports;

use App\Jk_al;
use Maatwebsite\Excel\Concerns\FromCollection;

class Jk_alExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jk_al::all();
    }
}
