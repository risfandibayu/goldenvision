<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gold;
use App\Models\sendgold;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //
    public function index(){
        $page_title = 'Gold Delivery';
        $empty_message = "Gold Delivery Request Not Found!";
        $items = sendgold::join('golds','golds.id','=','sendgolds.gold_id')
        ->join('products','products.id','=','golds.prod_id')
        ->leftjoin('corders','corders.gold_id','=','golds.id')
        ->select('sendgolds.*','golds.is_custom','products.name as pname', 'products.weight as pweight','corders.name as cname')
        ->orderBy('sendgolds.created_at','DESC')
        ->paginate(getPaginate());
        return view('admin.delivery.delivery',compact('page_title','items','empty_message'));
    }

    public function delivery(Request $request){
        // dd($request->all());
        $sg = sendgold::where('id',$request->id)->first();
        $sg->no_resi = $request->no_resi;
        $sg->status = 1;
        $sg->save();

        $gold = Gold::where('id',$sg->gold_id)->first();
        $gold->qty -= $sg->qty;
        $gold->save();

        $notify[] = ['success', 'Gold Deliver successfully'];
        return back()->withNotify($notify);
    }
}
