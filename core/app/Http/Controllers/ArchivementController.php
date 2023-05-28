<?php

namespace App\Http\Controllers;

use App\Models\ureward;
use Illuminate\Http\Request;

class ArchivementController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    public function index(){
        $data['page_title'] = "Archivement";
        $data['user']       = auth()->user();
        $data['title']          = title();
        $data['bonus']      = ureward::with(['user'])->where('user_id',auth()->user()->id)->get();
        return view($this->activeTemplate . 'user.archivement', $data);
    }

}
