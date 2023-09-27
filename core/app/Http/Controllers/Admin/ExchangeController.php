<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Gold;
use App\Models\GoldExchange;
use App\Models\User;
use App\Models\UserGold;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    //
    public function index(){
        $page_title = 'Exchange';
        $empty_message = "Gold Exchange Request Not Found!";
        $items = GoldExchange::select('gold_exchanges.*','users.username as us','users.id as usid','products.name as pdname')
        ->leftjoin('users','users.id','=','gold_exchanges.user_id')
        ->leftjoin('products','products.id','=','gold_exchanges.prod_id')
        ->orderBy('gold_exchanges.created_at','DESC')
        ->paginate(getPaginate());
        return view('admin.exchange.exchange',compact('page_title','items','empty_message'));
    }
    public function goldQwa(){
        $data['page_title'] = 'Exchange';
        $data['empty_message'] = "Gold Exchange Request Not Found!";
        $data['items'] = User::select('username','users.id')
        ->join('user_extras','users.id','=','user_extras.user_id')
        ->whereNotIn('firstname',['ptmmi','masterplan'])->where('wd_gold',0)
        ->where('user_extras.is_gold',1)
        ->paginate();
        // dd($data);
        return view('admin.exchange.gold',$data);
    }

    public function reject($id){
        $ex = GoldExchange::where('id',$id)->first();
        $ex->status = 3;
        $ex->save();

        sendEmail2($ex->user_id, 'exchange_cancel', [
            'trx' => $ex->ex_id,
            'amount' => 1,
            'currency' => 'gr',
            'post_balance' => $ex->qty_after
        ]);

        $notify[] = ['success', 'Gold exchange request rejected successfully.'];
        return redirect()->back()->withNotify($notify);
    }
    public function verify($id){
        $ex = GoldExchange::where('id',$id)->first();
        $ex->status = 2;
        $ex->save();

        $sip =  Gold::where('user_id',$ex->user_id)->where('prod_id',$ex->prod_id)->first();
        $sip->qty -= $ex->qty;
        $sip->save();

        sendEmail2($ex->user_id, 'exchange_accept', [
            'trx' => $ex->ex_id,
            'amount' => 1,
            'currency' => 'gr',
            'post_balance' => $ex->qty_after
        ]);

        $notify[] = ['success', 'Gold exchange request accepted successfully.'];
        return redirect()->back()->withNotify($notify);
    }
}
