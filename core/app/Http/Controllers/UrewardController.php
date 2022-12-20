<?php

namespace App\Http\Controllers;

use App\Models\ureward;
use App\Http\Controllers\Controller;
use App\Models\BonusReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrewardController extends Controller
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
     * @param  \App\Models\ureward  $ureward
     * @return \Illuminate\Http\Response
     */
    public function show(ureward $ureward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ureward  $ureward
     * @return \Illuminate\Http\Response
     */
    public function edit(ureward $ureward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ureward  $ureward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ureward $ureward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ureward  $ureward
     * @return \Illuminate\Http\Response
     */
    public function destroy(ureward $ureward)
    {
        //
    }

    public function claimReward($id){
        $rew = BonusReward::find($id);

        $cr = new ureward();
        $cr->trx = getTrx();
        $cr->user_id = Auth::user()->id;
        $cr->reward_id = $rew->id;
        $cr->save();

        $notify[] = ['success', 'Reward successfully claimed!!'];
        return redirect()->back()->withNotify($notify);
    }

    public function userReward(){
        $page_title = 'Bonus Reward';
        $empty_message = 'Bonus Reward Not found.';
        $reward = ureward::where('user_id',Auth::user()->id)->paginate(getPaginate());
        // dd($reward);

        return view('templates.basic.user.reward',compact('page_title', 'empty_message','reward'));
    }

    public function printTicket($id){

        $pageTitle = "Ticket Print";
        $ticket = ureward::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if (!$ticket) {
            # code...
            return redirect()->back();
        }
        return view('templates.basic.user.print_ticket', compact('ticket', 'pageTitle'));
    }
}
