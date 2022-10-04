<?php

namespace App\Http\Controllers;

use App\Models\GoldExchange;
use App\Models\sendgold;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function bvBonusLog(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Matching Bonus search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'matching_bonus')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Matching Bonus';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'matching_bonus')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function investLog(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Invest search : " . $search;
            // $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->where('trx', 'like', "%$search%")->orwhere('remark', 'purchased_product')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());\
            $data['transactions'] = Transaction::where('user_id',Auth::user()->id)->where('remark', 'purchased_plan')->where('trx', 'like', "%$search%")->orwhere('remark', 'purchased_product')->where('user_id',Auth::user()->id)->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Invest Log';
            // $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->orwhere('remark', 'purchased_product')->latest()->paginate(getPaginate());
            $data['transactions'] = Transaction::where('user_id',Auth::user()->id)->where('remark', 'purchased_plan')->orwhere('remark', 'purchased_product')->where('user_id',Auth::user()->id)->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function binaryCom(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Binary Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Binary Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function refCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Referral Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'referral_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Referral Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'referral_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function transactions(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Transaction search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Transaction Log';
            $data['transactions'] = auth()->user()->transactions()->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No transactions.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function depositHistory(Request $request)
    {

        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Deposit search : " . $search;
            $data['logs'] = auth()->user()->deposits()->where('trx', 'like', "%$search%")->with(['gateway'])->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Deposit Log';
            $data['logs'] = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No history found.';


        return view($this->activeTemplate . 'user.deposit_history', $data);
    }


    public function withdrawLog(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Withdraw search : " . $search;
            $data['withdraws'] = auth()->user()->withdrawals()->where('trx', 'like', "%$search%")->with('method')->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = "Withdraw Log";
            $data['withdraws'] = auth()->user()->withdrawals()->with('method')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = "No Data Found!";
        return view($this->activeTemplate . 'user.withdraw.log', $data);
    }

    public function exchangeLog(Request $request){
        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Gold Exchange search : " . $search;
            $data['exchange'] = GoldExchange::where('user_id',Auth::user()->id)->where('ex_id', 'like', "%$search%")
            ->join('products','products.id','=','gold_exchanges.prod_id')
            ->select('gold_exchanges.*','products.name')
            ->orderBy('gold_exchanges.created_at','DESC')
            ->paginate(getPaginate());
        } else {
            $data['page_title'] = "Gold Exchange Log";
            $data['exchange'] = GoldExchange::where('user_id',Auth::user()->id)->join('products','products.id','=','gold_exchanges.prod_id')->select('gold_exchanges.*','products.name')
            ->orderBy('gold_exchanges.created_at','DESC')
            ->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = "No Data Found!";
        return view($this->activeTemplate . 'user.exchangeGold', $data);
    }
    public function deliveryLog(Request $request){
        $search = $request->search;

        // if ($search) {
        //     $data['page_title'] = "Gold Delivery search : " . $search;
        //     $data['delivery'] = sendgold::where('user_id',Auth::user()->id)->where('trx', 'like', "%$search%")
        //     ->join('products','products.id','=','gold_exchanges.prod_id')
        //     ->select('gold_exchanges.*','products.name')
        //     ->orderBy('gold_exchanges.created_at','DESC')
        //     ->paginate(getPaginate());
        // } else {
            $data['page_title'] = "Gold Exchange Log";
            $data['delivery'] = sendgold::where('sendgolds.user_id',Auth::user()->id)
            ->join('golds','golds.id','=','sendgolds.gold_id')
            ->join('products','products.id','=','golds.prod_id')
            ->leftjoin('corders','corders.gold_id','=','golds.id')
            ->select('sendgolds.*','golds.is_custom','products.name as pname', 'products.weight as pweight','corders.name as cname')
            ->orderBy('sendgolds.created_at','DESC')
            ->paginate(getPaginate());

            // dd($data['delivery']);
        // }
        $data['search'] = $search;
        $data['empty_message'] = "No Data Found!";
        return view($this->activeTemplate . 'user.deliveryGold', $data);
    }

}
