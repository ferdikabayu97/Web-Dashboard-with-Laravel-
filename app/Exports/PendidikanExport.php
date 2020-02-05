<?php

namespace App\Exports;

use App\Pendidikan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendidikanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pendidikan::all();
    }
}
