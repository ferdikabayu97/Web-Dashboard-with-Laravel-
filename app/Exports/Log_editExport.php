<?php

namespace App\Exports;

use App\Log_Edit;
use Maatwebsite\Excel\Concerns\FromCollection;

class Log_editExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Log_Edit::all();
    }
}
