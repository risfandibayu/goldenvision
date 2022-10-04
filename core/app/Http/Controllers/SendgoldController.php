<?php

namespace App\Http\Controllers;

use App\Models\sendgold;
use App\Http\Controllers\Controller;
use App\Models\Gold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendgoldController extends Controller
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
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function show(sendgold $sendgold)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function edit(sendgold $sendgold)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sendgold $sendgold)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function destroy(sendgold $sendgold)
    {
        //
    }

    public function goldDelivery(Request $request){
        // dd($request->all());

        $gold = Gold::where('id',$request->gid)->first();

        if ($request->qty > $gold->qty ) {
            # code...
            $notify[] = ['error', 'The qty you input exceeds the amount of gold you have'];
            return redirect()->back()->withNotify($notify);
        }

        $sg = new sendgold();
        $sg->trx = getTrx();
        $sg->user_id = Auth::user()->id;
        $sg->alamat = $request->alamat;
        $sg->gold_id = $request->gid;
        $sg->qty = $request->qty;
        $sg->status = 2;
        $sg->save();

        $notify[] = ['success', 'Gold delivery request is successful, please wait for confirmation.'];
        return redirect()->back()->withNotify($notify);
    }

}
