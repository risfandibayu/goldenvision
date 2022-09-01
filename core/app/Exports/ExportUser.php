<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class ExportUser implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email')->get();
    }
}
