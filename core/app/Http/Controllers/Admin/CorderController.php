<?php

namespace App\Http\Controllers\Admin;

use App\Models\corder;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Gold;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class CorderController extends Controller
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
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function show(corder $corder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function edit(corder $corder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, corder $corder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function destroy(corder $corder)
    {
        //
    }


    public function adminIndex(){
        // dd('s');
        $page_title = 'Custom Order';
        $empty_message = 'Custom order is empty.';
        // $type = 'pending';
        $corder = corder::all();
        return view('admin.custom_order.index', compact('page_title', 'empty_message','corder'));
    }
    
    public function detail(Request $request){
        $page_title = "Order Detail";
        $corder = corder::where('id',$request->id)->first();
        return view('admin.custom_order.detail', compact('page_title', 'corder'));

    }

    public function app(Request $request){
        $cor = corder::where('id',$request->id)->first();
        $cor->status = 3;
        $cor->save();


        // $gold = Gold::where('id','=',$cor->gold_id)->first();
        // $gold->status = 0;
        // $cor->save();
        $notify[] = ['success', 'Custom Order Approved Succesfully'];
        return redirect()->back()->withNotify($notify);
    }
    public function rej(Request $request){
        
        $cor = corder::where('id',$request->id)->first();
        $cor->status = 4;
        $cor->admin_feedback = $request->ket;
        $cor->save();

        $notify[] = ['success', 'Custom Order Approved Succesfully'];
        return redirect()->back()->withNotify($notify);
    }
    public function upd(Request $request){
        $cor = corder::where('id',$request->id)->first();
        $cor->status = 1;
        $cor->save();


        $gold = Gold::where('id','=',$cor->gold_id)->first();
        $gold->status = 0;
        $gold->save();
        $notify[] = ['success', 'Update Order Status Succesfully'];
        return redirect()->back()->withNotify($notify);
    }
}
