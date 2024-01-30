<?php

namespace App\Http\Controllers;

use App\Models\BvLog;
use App\Models\GeneralSetting;
use App\Models\Gold;
use App\Models\Plan;
use App\Models\rekening;
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
    public function repeatOrder(){
        $data['page_title'] = "Reapeat Order";
        $data['plans'] = Plan::whereStatus(1)->get();
        return view($this->activeTemplate . '.user.plan_ro', $data);
    }
    public function buyMpStore(Request $request){

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
            'amount' => $plan->price * $request->qty,
            'trx_type' => '-',
            'details' => 'Purchased ' . $plan->name . ' For '.$request->qty.' MP',
            'remark' => 'purchased_plan',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);
        $notif = 'Purchased new MP quantity for '.$request->qtyy.' MP Successfully';
       

        if(countAllBonus() >= 10000000){
            $ux = UserExtra::where('user_id',auth()->user()->id)->first();
            $ux->last_ro += countAllBonus();
            $ux->save();
            $notif = 'Purchased new MP Repeat Order quantity for '.$request->qtyy.' MP Successfully';

        }

        $notify[] = ['success', $notif];
        addToLog($notif);
        return redirect()->route('user.home')->withNotify($notify);

    }

    function planStore(Request $request)
    {
        if($request->package >= 26){
            $notify[] = ['error', 'For now, you can only create max 25 user'];
            return redirect()->intended('/user/profile-setting')->withNotify($notify);
        }
        $checkloop  = $request->package > 1  ? true:false;
        
        $checkBankAcc = rekening::where('user_id',auth()->user()->id)->first();
        if ($checkloop) {
            if(!$checkBankAcc){
                $notify[] = ['error', 'Please Field your bank acc before subscibe more than 1 account'];
                return redirect()->intended('/user/profile-setting')->withNotify($notify);
            }
        }
        $this->validate($request, [
            'plan_id' => 'required|integer', 
            'qty' => 'required',
        ]);
        $request['position'] = $request->position ?? 2;

        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();
        $brolimit = user::where('plan_id','!=',0)->count();

        $user = Auth::user();
        $ref_user = User::where('no_bro', $request->sponsor)->first();
        $oldPlan = $user->plan_id;
        $sponsor = User::where('no_bro', $request->sponsor)->first();
        if (!$sponsor) {
            $notify[] = ['error', 'Invalid Sponsor MP Number.'];
            return back()->withNotify($notify);
        }

        $activePin = Auth::user()->pin;
        if ($activePin < $request->qty) {
            $notify[] = ['error', 'Insufficient Balance, Not Enough PIN to Buy'];
            return back()->withNotify($notify);
        }

        $firstUpline = $this->placementFirstAccount($user,$request,$ref_user,$plan,$sponsor);
        

        $checkloop  = $request->package > 1  ? true:false;
        if (!$checkloop) {
            $notify[] = ['success', 'Purchased ' . $plan->name . ' Successfully'];
            return redirect()->route('user.home')->withNotify($notify);
        }


        $registeredUser = $request->package;
        $position = 2;


        for ($i=1; $i < $registeredUser; $i++) { 
            if($i <= 4){
                $sponsor = $firstUpline;
                $mark = 1;
                // 02: 2,3,4,5
            }
            if ($i >= 5 && $i <= 8) {
                $sponsor = User::where('username',Auth::user()->username  . 2)->first();
                $mark = 2;
                // 03: 6,7,8,9
            }
            if ($i >= 9  && $i <= 12) {
                $mark = 3;
                $sponsor = User::where('username',Auth::user()->username  . 3)->first();
                // 04: 10,11,12,13,14
            }
            if ($i >= 13 && $i <= 16) {
                $mark =4;
                $sponsor = User::where('username',Auth::user()->username  . 4)->first();
                // 05: 15,16,17,18,19
            }
            if ($i >= 17 && $i<= 20) {
                $mark = 5;
                $sponsor = User::where('username',Auth::user()->username  . 5)->first();
                // 06: 20,21,22,13,24
            }
            if ($i >= 21 && $i<= 24) {
                $sponsor = User::where('username',Auth::user()->username  . 6)->first();
            }
            $bro_upline = $firstUpline->no_bro;
            $firstnameNewUser = $firstUpline->firstname;
            $lastnameNewUser = $firstUpline->lastname;
            $usernameNewUser = $firstUpline->username . $i+1;
            $emailNewUser = $firstUpline->email;
            $phoneNewUser = $firstUpline->mobile;
            $pinNewUser = 1;
            $newBankName = $checkBankAcc->nama_bank??null;
            $newBankAcc = $checkBankAcc->nama_akun??null;
            $newBankNo = $checkBankAcc->no_rek??null;
            $newBankCity = $checkBankAcc->kota_cabang??null;

            $nextUser = fnRegisterUser(
                $sponsor,
                $bro_upline,
                $position,
                $firstnameNewUser,
                $lastnameNewUser,
                $usernameNewUser,
                $emailNewUser,
                $phoneNewUser,
                $pinNewUser,
                $newBankName,
                $newBankCity,
                $newBankAcc,
                $newBankNo
            );
           
            $bro_upline = $nextUser->no_bro;

            $user = UserExtra::where('user_id',$sponsor->id)->first();
            $user->is_gold = 1;
            $user->save();
        }
        
        $notify[] = ['success', 'Purchased ' . $plan->name . 'and Registered New  '.$registeredUser.' Account Successfully'];
        return redirect()->route('user.home')->withNotify($notify);

    }
    function placementFirstAccount($user,$request,$ref_user,$plan,$sponsor)
    {
        $gnl = GeneralSetting::first();

        $pos = getPosition($ref_user->id, $request->position);
        $user->no_bro           = generateUniqueNoBro();
        $user->ref_id           = $sponsor->id; // ref id = sponsor
        $user->pos_id           = $pos['pos_id']; //pos id = upline
        $user->position         = $pos['position'];
        $user->position_by_ref  = $ref_user->position;
        $user->plan_id          = $plan->id;
        $user->pin              -= $request->package;
        $user->total_invest     += ($plan->price * 1);
        $user->save();

        $spin = UserPin::create([
            'user_id' => $user->id,
            'pin'     => $request->package,
            'pin_by'  => $user->id,
            'type'      => "-",
            'start_pin' => $user->pin,
            'end_pin'   => $sponsor->pin -( $request->package-1),
            'ket'       => 'Sponsor Subscibe and Create '.$request->package.'New User'
        ]);

      
        brodev(Auth::user()->id, $request->qty);

        $trx = $user->transactions()->create([
            'amount' => $plan->price * $request->qty,
            'trx_type' => '-',
            'details' => 'Purchased ' . $plan->name . ' For '.$request->qty.' MP',
            'remark' => 'purchased_plan',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);
        addToLog('Purchased ' . $plan->name . ' For '.$request->qty.' MP');

        sendEmail2($user->id, 'plan_purchased', [
            'plan' => $plan->name. ' For '.$request->qty.' MP',
            'amount' => getAmount($plan->price * $request->qty),
            'currency' => $gnl->cur_text,
            'trx' => $trx->trx,
            'post_balance' => getAmount($user->balance),
        ]);

            
        $details = Auth::user()->username . ' Subscribed to ' . $plan->name . ' plan.';

        referralCommission2($user->id, $details);
        
        updatePaidCount2($user->id);

        updateCycleNasional($user->id);

        return $user;
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
