<?php

namespace App\Exports;

use App\Sk;
use Maatwebsite\Excel\Concerns\FromCollection;

class SkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sk::all();
    }
}
