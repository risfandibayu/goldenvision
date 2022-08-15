<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GoldExchange;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    //
    public function index(){
        $page_title = 'Exchange';
        $items = GoldExchange::select('gold_exchanges.*','users.username as us','products.name as pdname')
        ->leftjoin('users','users.id','=','gold_exchanges.user_id')
        ->leftjoin('products','products.id','=','gold_exchanges.prod_id')
        ->paginate(getPaginate());
        return view('admin.exchange.exchange',compact('page_title','items'));
    }

    public function reject($id){
        $ex = GoldExchange::where('id',$id)->first();
        $ex->status = 3;
        $ex->save();

        $notify[] = ['success', 'Gold exchange request rejected successfully.'];
        return redirect()->back()->withNotify($notify);
    }
    public function verify($id){
        $ex = GoldExchange::where('id',$id)->first();
        $ex->status = 2;
        $ex->save();

        $notify[] = ['success', 'Gold exchange request accepted successfully.'];
        return redirect()->back()->withNotify($notify);
    }
}
