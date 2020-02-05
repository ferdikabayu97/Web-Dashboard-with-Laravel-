<?php

namespace App\Exports;

use App\Jk;
use Maatwebsite\Excel\Concerns\FromCollection;

class JkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jk::all();
    }
}
