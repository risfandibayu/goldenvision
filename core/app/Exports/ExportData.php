<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExportData implements FromQuery
{
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    use Exportable;

    public function __construct($query)
    {
        $this->query = $query;
    }
    public function query()
    {
        return $this->query;
    }
}
