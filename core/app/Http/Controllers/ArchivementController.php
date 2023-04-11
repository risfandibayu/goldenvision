<?php

namespace App\Http\Controllers;

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
        return view($this->activeTemplate . 'user.archivement', $data);
    }

}
