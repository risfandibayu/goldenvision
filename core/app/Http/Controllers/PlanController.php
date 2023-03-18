<?php

namespace App\Http\Controllers;

use App\Models\BvLog;
use App\Models\GeneralSetting;
use App\Models\Gold;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use App\Models\UserPin;
use App\Services\Tree\Enums\TreePosition;
use App\Services\Tree\TreeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function __construct(public TreeService $treeService)
    {
        $this->activeTemplate = activeTemplate();
    }

    function planIndex()
    {
        $data['page_title'] = "Plans";
        $data['plans'] = Plan::whereStatus(1)->get();
        return view($this->activeTemplate . '.user.plan', $data);

    }

    // function planStore(Request $request){
    //     brodev(Auth::user()->id, $request->qty);
    // }
    public function buyMpStore(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'qtyy' => 'required|integer|min:1',
        ]);
        $activePin  = Auth::user()->pin;

        $user = User::find(Auth::id());
        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();
        if ($activePin < $request->qtyy) {
            $notify[] = ['error', 'Insufficient Balance, Not Enough PIN to Buy'];
            return back()->withNotify($notify);
        }
        UserPin::create([
            'user_id' => $user->id,
            'pin'     => $request->qtyy,
            'pin_by'  => $user->id,
            'type'      => '-',
            'start_pin' => $user->pin,
            'end_pin'   => $user->pin - $request->qtyy,
            'ket'       => 'Purchased ' . $plan->name . ' For '.$request->qtyy.' MP',
        ]);
        
        $user->pin -= $request->qtyy;
        $user->total_invest += ($plan->price * $request->qtyy);
        $user->bro_qty += $request->qtyy;
        $user->save();

        $trx = $user->transactions()->create([
            'amount' => $plan->price * $request->qtyy,
            'trx_type' => '-',
            'details' => 'Purchased ' . $plan->name . ' For '.$request->qtyy.' MP',
            'remark' => 'purchased_plan',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);


        $notify[] = ['success', 'Purchased new MP quantity for '.$request->qtyy.' MP Successfully'];
        return redirect()->route('user.home')->withNotify($notify);

    }

    function planStore(Request $request)
    {

        $this->validate($request, [
            'plan_id' => 'required|integer',
            'referral' => 'required',
            'position' => 'required',
            'qty' => 'required',
        ]);
        // dd($request->all());
        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();
        // dd(date('Y-m-d,H:i:s'));

        $brolimit = user::where('plan_id','!=',0)->count();
        // dd($brolimit);
        // if (date('Y-m-d,H:i:s') > '2022-09-02,23:59:59') {
        //     # code...
        //     // dd('s');
        //     $g1 = 50;
        //     $g2 = 20;
        //     $g3 = 5;
        //     $g4 = 2;
        //     $tot = 77;
        // }else{
        //     // dd('w');
        //     $g1 = 70;
        //     $g2 = 20;
        //     $g3 = 7;
        //     $g4 = 2;
        //     $tot = 99;
        // }


        $user = User::find(Auth::id());
        $ref_user = User::where('no_bro', $request->referral)->first();
        if ($ref_user == null && $request->referral) {
            $notify[] = ['error', 'Invalid Upline MP Number.'];
            return back()->withNotify($notify);
        }
        if ($ref_user) {
            # code...
            $cek_pos = User::where('pos_id', $ref_user->id)->where('position',$request->position)->first();
    
            if(!treeFilter($ref_user->id,$ref_user->id)){
                $notify[] = ['error', 'Refferal and Upline BRO number not in the same tree.'];
                return back()->withNotify($notify);
            }
            
            if ($cek_pos) {
                $notify[] = ['error', 'Node you input is already filled.'];
                return back()->withNotify($notify);
            }
        }
        $sponsor = User::where('no_bro', $request->sponsor)->first();
        if (!$sponsor) {
            $notify[] = ['error', 'Invalid Sponsor MP Number.'];
            return back()->withNotify($notify);
        }
        if($ref_user->no_bro == $user->no_bro){
            $notify[] = ['error', 'Invalid Input MP Number. You can`t input your own MP number'];
            return back()->withNotify($notify);
        }

        $activePin = Auth::user()->pin;
        if ($activePin < $request->qtyy) {
            $notify[] = ['error', 'Insufficient Balance, Not Enough PIN to Buy'];
            return back()->withNotify($notify);
        }

        $oldPlan = $user->plan_id;

        $pos = getPosition($ref_user->id, $request->position);
        $user->no_bro       = generateUniqueNoBro();
        $user->ref_id       = $sponsor->id; // ref id = sponsor
        $user->pos_id       = $ref_user->id; //pos id = upline
        $user->position     = $request->position;
        $user->position_by_ref = $ref_user->position;
        $user->plan_id      = $plan->id;
        // $user->balance      -= ($plan->price * $request->qty);
        $user->pin              -= $request->qty;
        $user->total_invest += ($plan->price * $request->qty);
        $user->bro_qty      = $request->qty - 1;
        $user->save();


            // $this->treeService->calculateUplineMemberBonus(
            //     $user,
            //     $ref_user,
            //     TreePosition::from((int) $request->position)
            // );

            // $gold = Gold::where('user_id',Auth::user()->id)->first();
            // $gold1 = Gold::where('user_id',Auth::user()->id)->where('prod_id',1)->first();
            // $gold2 = Gold::where('user_id',Auth::user()->id)->where('prod_id',2)->first();
            // $gold3 = Gold::where('user_id',Auth::user()->id)->where('prod_id',3)->first();
            // $gold4 = Gold::where('user_id',Auth::user()->id)->where('prod_id',4)->first();

            // if($gold){
            //     if($gold1){
            //         $gold1->qty += $g1 * $request->qty;
            //         $gold1->save();
            //     }else{
            //         $newg = new Gold();
            //         $newg->user_id = Auth::user()->id;
            //         $newg->prod_id = 1;
            //         $newg->qty = $g1 * $request->qty;
            //         $newg->save();
            //     }

            //     if($gold2){
            //         $gold2->qty += $g2 * $request->qty;
            //         $gold2->save();
            //     }else{
            //         $newg = new Gold();
            //         $newg->user_id = Auth::user()->id;
            //         $newg->prod_id = 2;
            //         $newg->qty = $g2 * $request->qty;
            //         $newg->save();
            //     }

            //     if($gold3){
            //         $gold3->qty += $g3 * $request->qty;
            //         $gold3->save();
            //     }else{
            //         $newg = new Gold();
            //         $newg->user_id = Auth::user()->id;
            //         $newg->prod_id = 3;
            //         $newg->qty = $g3 * $request->qty;
            //         $newg->save();
            //     }

            //     if($gold4){
            //         $gold4->qty += $g4 * $request->qty;
            //         $gold4->save();
            //     }else{
            //         $newg = new Gold();
            //         $newg->user_id = Auth::user()->id;
            //         $newg->prod_id = 4;
            //         $newg->qty = $g4 * $request->qty;
            //         $newg->save();
            //     }


            // }else{
            //     $newg = new Gold();
            //     $newg->user_id = Auth::user()->id;
            //     $newg->prod_id = 1;
            //     $newg->qty = $g1 * $request->qty;
            //     $newg->save();

            //     $newg = new Gold();
            //     $newg->user_id = Auth::user()->id;
            //     $newg->prod_id = 2;
            //     $newg->qty = $g2 * $request->qty;
            //     $newg->save();

            //     $newg = new Gold();
            //     $newg->user_id = Auth::user()->id;
            //     $newg->prod_id = 3;
            //     $newg->qty = $g3 * $request->qty;
            //     $newg->save();

            //     $newg = new Gold();
            //     $newg->user_id = Auth::user()->id;
            //     $newg->prod_id = 4;
            //     $newg->qty = $g4 * $request->qty;
            //     $newg->save();
            // }

        brodev(Auth::user()->id, $request->qty);

        $trx = $user->transactions()->create([
            'amount' => $plan->price * $request->qty,
            'trx_type' => '-',
            'details' => 'Purchased ' . $plan->name . ' For '.$request->qty.' MP',
            'remark' => 'purchased_plan',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);

        // dd($user);

        sendEmail2($user->id, 'plan_purchased', [
            'plan' => $plan->name. ' For '.$request->qty.' MP',
            'amount' => getAmount($plan->price * $request->qty),
            'currency' => $gnl->cur_text,
            'trx' => $trx->trx,
            'post_balance' => getAmount($user->balance),
        ]);
        if ($oldPlan == 0) {
            updatePaidCount2($user->id);
        }
            
        $details = Auth::user()->username . ' Subscribed to ' . $plan->name . ' plan.';

        // updateBV($user->id, $plan->bv, $details);

        // if ($plan->tree_com > 0) {
        //     treeComission($user->id, $plan->tree_com, $details);
        // }

        referralCommission2($user->id, $details);

        $notify[] = ['success', 'Purchased ' . $plan->name . ' Successfully'];
        return redirect()->route('user.home')->withNotify($notify);

    }


    public function binaryCom()
    {
        $data['page_title'] = "Binary Commission";
        $data['logs'] = Transaction::where('user_id', auth()->id())->where('remark', 'binary_commission')->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $data['empty_message'] = 'No data found';
        return view($this->activeTemplate . '.user.transactions', $data);
    }

    public function binarySummery()
    {
        $data['page_title'] = "Binary Summery";
        $data['logs'] = UserExtra::where('user_id', auth()->id())->firstOrFail(); 
    }

    public function bvlog(Request $request)
    {

        if ($request->type) {
            if ($request->type == 'leftBV') {
                $data['page_title'] = "Left BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('position', 1)->where('trx_type', '+')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            } elseif ($request->type == 'rightBV') {
                $data['page_title'] = "Right BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('position', 2)->where('trx_type', '+')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            } elseif ($request->type == 'cutBV') {
                $data['page_title'] = "Cut BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('trx_type', '-')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            } else {
                $data['page_title'] = "All Paid BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('trx_type', '+')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            }
        } else {
            $data['page_title'] = "BV LOG";
            $data['logs'] = BvLog::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        }

        $data['empty_message'] = 'No data found';
        return view($this->activeTemplate . '.user.bvLog', $data);
    }

    public function myRefLog()
    {
        $data['page_title'] = "My Referral";
        $data['empty_message'] = 'No data found';
        $data['logs'] = User::where('ref_id', auth()->id())->latest()->paginate(config('constants.table.default'));
        return view($this->activeTemplate . '.user.myRef', $data);
    }

    public function myTree()
    {
        $data['tree'] = showTreePage(Auth::id());
        $data['page_title'] = "My Tree";
        return view($this->activeTemplate . 'user.myTree', $data);
    }


    public function otherTree(Request $request, $username = null)
    {
        if ($request->username) {
            $user = User::where('username', $request->username)->first();
        } else {
            $user = User::where('username', $username)->first();
        }
        if ($user && treeAuth($user->id, auth()->id())) {
            $data['tree'] = showTreePage($user->id);
            $data['page_title'] = "Tree of " . $user->fullname;
            return view($this->activeTemplate . 'user.myTree', $data);
        }

        $notify[] = ['error', 'Tree Not Found or You do not have Permission to view that!!'];
        return redirect()->route('user.my.tree')->withNotify($notify);

    }

}
