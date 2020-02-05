<?php

namespace App\Exports;

use App\Sk_al;
use Maatwebsite\Excel\Concerns\FromCollection;

class Sk_alExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sk_al::all();
    }
}
