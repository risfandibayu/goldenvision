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

        $prod = Product::where('id','=',$cor->prod_id)->first();
        $user = User::where('id','=',$cor->user_id)->first();

        if (($prod->price * $cor->qty) >= 11000000) {
            # code...
            $user->bro_qty += intval(($prod->price * $cor->qty) / 11000000);
            $user->save();

            $qty = intval(($prod->price * $cor->qty) / 11000000);

            if (date('Y-m-d,H:i:s') > '2022-09-02,23:59:59') {
                # code...
                // dd('s');
                $g1 = 50;
                $g2 = 20;
                $g3 = 5;
                $g4 = 2;
                $tot = 77;
            }else{
                // dd('w');
                $g1 = 70;
                $g2 = 20;
                $g3 = 7;
                $g4 = 2;
                $tot = 99;
            }

            $gold = Gold::where('user_id',$cor->user_id)->first();
            $gold1 = Gold::where('user_id',$cor->user_id)->where('prod_id',1)->where('from_bro','=',1)->first();
            $gold2 = Gold::where('user_id',$cor->user_id)->where('prod_id',2)->where('from_bro','=',1)->first();
            $gold3 = Gold::where('user_id',$cor->user_id)->where('prod_id',3)->where('from_bro','=',1)->first();
            $gold4 = Gold::where('user_id',$cor->user_id)->where('prod_id',4)->where('from_bro','=',1)->first();

            if($gold){
                if($gold1){
                    $gold1->qty += $g1 * $qty;
                    $gold1->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = $cor->user_id;
                    $newg->prod_id = 1;
                    $newg->qty = $g1 * $qty;
                    $newg->save();
                }

                if($gold2){
                    $gold2->qty += $g2 * $qty;
                    $gold2->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = $cor->user_id;
                    $newg->prod_id = 2;
                    $newg->qty = $g2 * $qty;
                    $newg->save();
                }

                if($gold3){
                    $gold3->qty += $g3 * $qty;
                    $gold3->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = $cor->user_id;
                    $newg->prod_id = 3;
                    $newg->qty = $g3 * $qty;
                    $newg->save();
                }

                if($gold4){
                    $gold4->qty += $g4 * $qty;
                    $gold4->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = $cor->user_id;
                    $newg->prod_id = 4;
                    $newg->qty = $g4 * $qty;
                    $newg->save();
                }


            }else{
                $newg = new Gold();
                $newg->user_id = $cor->user_id;
                $newg->prod_id = 1;
                $newg->qty = $g1 * $qty;
                $newg->save();

                $newg = new Gold();
                $newg->user_id = $cor->user_id;
                $newg->prod_id = 2;
                $newg->qty = $g2 * $qty;
                $newg->save();

                $newg = new Gold();
                $newg->user_id = $cor->user_id;
                $newg->prod_id = 3;
                $newg->qty = $g3 * $qty;
                $newg->save();

                $newg = new Gold();
                $newg->user_id = $cor->user_id;
                $newg->prod_id = 4;
                $newg->qty = $g4 * $qty;
                $newg->save();
            }
        }


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
