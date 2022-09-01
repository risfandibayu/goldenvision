<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Support\Facades\DB;

class ExptUserQuery implements FromQuery
{
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    use Exportable;

    public function __construct($search)
    {
        $this->search = $search;
    }
    public function query()
    {
        return User::query()->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email')
        ->where('username', 'like', "%$this->search%")
        ->orWhere('email', 'like', "%$this->search%")
        ->orWhere('no_bro', 'like', "%$this->search%")
        ->orWhere('mobile', 'like', "%$this->search%")
        ->orWhere('firstname', 'like', "%$this->search%")
        ->orWhere('lastname', 'like', "%$this->search%");
    }
}
