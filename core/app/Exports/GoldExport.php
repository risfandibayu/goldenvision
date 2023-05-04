<?php

namespace App\Exports;

use App\Models\DailyGold;
use App\Models\User;
use App\Models\UserExtra;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class GoldExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
        {
            $page_title = 'Manage Active Users';
            $empty_message = 'No active user found';
            // $table = UserExtra::with('user')->where('is_gold',1)->get();
            $table = UserExtra::userGold();
            $goldNow = DailyGold::orderByDesc('id')->first();
            return view('admin.users.goldExport', compact('page_title','table', 'empty_message','goldNow'));
        }
   
   
}
