<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserExtra;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        $active = UserExtra::with('user')->where('n_cyle',0)->orderBy('id','asc')->first();
        // dd($active);
        $data['cyle'] = $active;
        $data['downline'] = [
            '1' => $active->national_1 != null?User::find($active->national_1):null,
            '2' => $active->national_2 != null?User::find($active->national_2):null,
            '3' => $active->national_3 != null?User::find($active->national_3):null,
            '4' => $active->national_4 != null?User::find($active->national_4):null,
        ];
        return view('v3.home',$data);
    }
}
