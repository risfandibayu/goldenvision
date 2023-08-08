<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromQuery;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class ExptUserView implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $page_title = 'Manage Active Users';
        $empty_message = 'No active user found';
        $users = User::active()->latest()->get();
        return view('admin.users.export', compact('page_title', 'empty_message', 'users'));
    }
}
