<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Support\Facades\DB;

class ExptUserQueryPage implements FromQuery
{
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    use Exportable;

    public function __construct($page)
    {
        $this->page = $page;
    }
    public function query()
    {
        return $this->page;
    }
}
