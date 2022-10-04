<?php

namespace App\Http\Controllers;

use App\Models\alamat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function show(alamat $alamat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function edit(alamat $alamat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, alamat $alamat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function destroy(alamat $alamat)
    {
        //
    }

    public function add_address(Request $request){
        $alm = new alamat();
        $alm->user_id = Auth::user()->id;
        $alm->alamat = $request->alamat;
        $alm->save();

        $notify[] = ['success', 'Add New Address Successfully!'];
        return back()->withNotify($notify);
    }

    public function edit_address(Request $request){
        $alm = alamat::where('id',$request->id)->first();
        $alm->user_id = Auth::user()->id;
        $alm->alamat = $request->alamat;
        $alm->save();

        $notify[] = ['success', 'Edit Address Successfully!'];
        return back()->withNotify($notify);
    }
}
