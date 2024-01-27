<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\bank;
use App\Models\GeneralSetting;
use App\Models\Gold;
use App\Models\Plan;
use App\Models\rekening;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use App\Models\UserLogin;
use App\Models\UserPin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Tree\TreeService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SponsorRegisterController extends Controller
{
    public function __construct(public TreeService $treeService)
    {
        $this->activeTemplate = activeTemplate();
    }
    public function setSession(Request $request){
        
        $data = [
            'upline'    => $request->upline,
            'position'  => $request->postion,
            'url'       => $request->back
        ];
        $request->session()->put('SponsorSet', $data);
        return response()->json(['sts'=>200,'url'=>route('user.sponsor.regist')]);
    }

    public function index(){
        // dd(session()->get('SponsorSet')['url']);
        // dd($request->sesion()->get('SponsorSet'));
        $data['page_title'] = "Register By Sponsor";
        $data['user'] = Auth::user();
        $data['bank'] = bank::all();
        $data['upline'] = User::where('no_bro',session()->get('SponsorSet')['upline'])->first();
        return view($this->activeTemplate . 'user.registerSponsor', $data);
    }
    
    public function registerUser(Request $request){
        // dd($request->all());
        $validate = Validator::make($request->all(),[
            'sponsor'   => 'required',
            'upline'    => 'required',
            'position'  => 'required',
            'username'  => 'required|alpha_num|unique:users|min:6',
            'email'     => 'required|email',
            'phone'     => 'required',
            'pin'       => 'required|numeric|min:1',
            'bank_name' => 'required',
            'kota_cabang' => 'required',
            'acc_name' => 'required',
            'acc_number' => 'required',
        ]);
        if ($validate->fails()) {
            // dd('error validasi');
           return redirect()->back()->withInput($request->all())->withErrors($validate);
        }
        DB::beginTransaction();
        try {
            $user = $this->create($request->all());  //register user
            // create rekening
            $cekbank = rekening::where('nama_bank',$request->bank_name)
                            ->where('nama_akun','like','%'.$request->acc_name.'%')
                            ->where('no_rek','like','%'.$request->acc_number.'%')
                            ->first();
            if($cekbank){
                $rek = new rekening();  
                $rek->user_id = $user->id;
                $rek->nama_bank = $cekbank->bank_name??$request->bank_name;
                $rek->nama_akun = $cekbank->acc_name??$request->acc_name;
                $rek->no_rek = $cekbank->acc_number??$request->acc_number;
                $rek->kota_cabang = $cekbank->kota_cabang??$request->kota_cabang;
                $rek->save();
            }else{
                $rek = new rekening();  
                $rek->user_id = $user->id;
                $rek->nama_bank = $request->bank_name;
                $rek->nama_akun = $request->acc_name;
                $rek->no_rek = $request->acc_number;
                $rek->kota_cabang = $request->kota_cabang;
                $rek->save();
            }
            $pin = $this->addPin($request->pin,$user->id); //send pin to user

            if($pin['error']){
                $notify[] = ['error',$pin['msg']];
                return redirect()->route('user.my.tree')->withNotify($notify);
            }
            $buyPlan = $this->planStore([
                'plan_id'   => 1,
                'upline'    => $request->upline,
                'sponsor'   => $request->sponsor,
                'pin'       => $request->pin,
                'position'  => $request->position,
                'user_id'   => $user->id
            ]);
            if($buyPlan['error']){
                $notify[] = ['error',$buyPlan['msg']];
                return redirect()->route('user.my.tree')->withNotify($notify);

            }
            updateCycleNasional($user->id);
            
            DB::commit();
            
            $sponsor = User::where('no_bro',$request->sponsor)->first();
            sendEmail2($user->id,'sponsor_register',[
                'email' => $user->email,
                'sponsor'  => $sponsor->username,
                'user' => $user->username,
                'url' => url('/login?username='.$user->username.'&password='.$user->username),
            ]);

            addToLog('Created User '.$user->username.' & Purchased Plan');
            $notify[] = ['success', 'Created User '.$user->username.' & Purchased Plan Successfully'];
            return redirect(session()->get('SponsorSet')['url'])->withNotify($notify);
        } catch (\Throwable $th) {
            DB::rollBack();
            $notify[] = ['error', 'Created User Failed: '.$th->getMessage()];
            return redirect()->route('user.my.tree')->withNotify($notify);
        }
        
    }
    protected function create(array $data)
    {
        $gnl = GeneralSetting::first();
        $user = User::create([
            'firstname' => isset($data['firstname']) ? $data['firstname'] : null,
            'lastname'  => isset($data['lastname']) ? $data['lastname'] : null,
            'email'    => strtolower(trim($data['email'])),
            'password'  => Hash::make(strtolower(trim($data['username']))),
            'username'  => strtolower(trim($data['username'])),
            'mobile'    => 62 . $data['phone'],
            'address'   => [
                'address' => '',
                'state' => '',
                'zip' => '',
                'country' => 'Indonesia',
                'city' => ''
            ],
            'status'    => 1,
            'ev'        => 1,
            'sv'        => 1,
            'ts'        => 0,
            'tv'        => 1,
            'new_ps'    => 1,

        ]);
        UserExtra::create([
            'user_id' => $user->id
        ]);
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered By Sponsor: '.Auth::user()->username;
        $adminNotification->click_url = route('admin.users.detail', $user->id);
        $adminNotification->save();

        //Login Log Create
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->location =  $exist->location;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',', $info['long']);
            $userLogin->latitude =  @implode(',', $info['lat']);
            $userLogin->location =  @implode(',', $info['city']) . (" - " . @implode(',', $info['area']) . "- ") . @implode(',', $info['country']) . (" - " . @implode(',', $info['code']) . " ");
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();
      

        return $user;
    }
    public function addPin($pin,$user_id){
       
        $user = User::find($user_id);
        $sponsor = Auth::user();
        $trx = getTrx();
        try {
            if ($sponsor->pin < $pin) {
                return ['error'=>true, 'msg'=> 'Not enough pin to send'];
            }
            $spin = UserPin::create([
                'user_id' => $sponsor->id,
                'pin'     => $pin,
                'pin_by'  => $user->id,
                'type'      => "-",
                'start_pin' => $sponsor->pin,
                'end_pin'   => $sponsor->pin - $pin,
                'ket'       => 'Sponsor Create and Send '.$pin.' Pin to: '. $user->username
            ]);
            $sponsor->pin -= $pin;
            $sponsor->save();

            $upin = UserPin::create([
                'user_id' => $user_id,
                'pin'     => $pin,
                'pin_by'  => $sponsor->id,
                'type'      => '+',
                'start_pin' => $user->pin,
                'end_pin'   => $user->pin + $pin,
                'ket'       => 'Added Pin By Sponsor: '. $sponsor->username
            ]);
            addToLog('Sponsor Create and Send '.$pin.' Pin to: '. $user->username);
           
            
            $user->pin += $pin;
            $user->save();
            
            // $transaction = new Transaction();
            // $transaction->user_id = $user_id;
            // $transaction->amount = $pin;
            // $transaction->post_balance = 0;
            // $transaction->charge = 0;
            // $transaction->trx_type = '+';
            // $transaction->details = 'Added Pin Via Admin';
            // $transaction->trx =  $trx;
            // $transaction->save();

            return ['sts'=>$user->pin,'error'=>false];
        } catch (\Throwable $th) {
            return ['error'=>true, 'msg'=> 'Error: '.$th->getMessage()];
        }
         
    }
    public function planStore($data)
    {
        // dd($request->all());
        $plan = Plan::where('id', $data['plan_id'])->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();

        $user = User::find($data['user_id']);
        // $ref_user = null;
        $ref_user = User::where('no_bro', $data['upline'])->first();
        if ($ref_user == null && $data['upline']) {
            return ['error'=>true, 'msg'=>'Invalid Upline MP Number.'];
        }
        if ($ref_user) {
            # code...
            $cek_pos = User::where('pos_id', $ref_user->id)->where('position',$data['position'])->first();
    
            if(!treeFilter($ref_user->id,$ref_user->id)){
                return ['error'=>true, 'msg'=> 'Refferal and Upline BRO number not in the same tree.'];
            }
            
            if ($cek_pos) {
                return ['error'=>true, 'msg'=> 'Node you input is already filled.'];
            }
        }
        $sponsor = User::where('no_bro', $data['sponsor'])->first();
        if (!$sponsor) {
            return ['error'=>true, 'msg'=> 'Invalid Sponsor MP Number.'];
        }
        if($ref_user->no_bro == $user->no_bro){
            return ['error'=>true, 'msg'=> 'Invalid Input MP Number. You can`t input your own MP number'];
        }
        if($data['pin'] > $user->pin){
            return ['error'=>true, 'msg'=> 'User Doesn Have Enough Pin'];
        }

        $oldPlan = $user->plan_id;

        $pos = getPosition($ref_user->id, $data['position']);
        try {
            $upin = UserPin::create([
                'user_id' => $user->id,
                'pin'     => $data['pin'],
                'pin_by'  => $user->id,
                'type'      => '-',
                'start_pin' => $user->pin,
                'end_pin'   => $user->pin - $data['pin'],
                'ket'       => 'Purchased ' . $plan->name . ' For '.$data['pin'].' MP',
            ]);

            $user->no_bro           = generateUniqueNoBro();
            $user->ref_id           = $sponsor->id; // ref id = sponsor
            $user->pos_id           = $ref_user->id; //pos id = upline
            $user->position         = $data['position'];
            $user->position_by_ref  = $ref_user->position;
            $user->plan_id          = $plan->id;
            $user->pin              -= $data['pin'];
            $user->total_invest     += ($plan->price * $data['pin']);
            $user->bro_qty          = $data['pin'] - 1;
            $user->save();

            brodev($data['user_id'], $data['pin']);

            $trx = $user->transactions()->create([
                'amount' => $plan->price * $data['pin'],
                'trx_type' => '-',
                'details' => 'Purchased ' . $plan->name . ' For '.$data['pin'].' MP',
                'remark' => 'purchased_plan',
                'trx' => getTrx(),
                'post_balance' => getAmount($user->balance),
            ]);

            // dd($user);

            sendEmail2($user->id, 'plan_purchased', [
                'plan' => $plan->name. ' For '.$data['pin'].' MP',
                'amount' => getAmount($plan->price * $data['pin']),
                'currency' => $gnl->cur_text,
                'trx' => getTrx(),
                'post_balance' => getAmount($user->balance),
            ]);
            if ($oldPlan == 0) {
                updatePaidCount2($user->id);
            }
            $userSponsor = User::find($data['user_id']);
            $details = $userSponsor->username. ' Subscribed to ' . $plan->name . ' plan.';

            // updateBV($user->id, $plan->bv, $details);

            // if ($plan->tree_com > 0) {
            //     treeComission($user->id, $plan->tree_com, $details);
            // }
            addToLog('Purchased ' . $plan->name . ' For '.$data['pin'].' MP as Sponsor');

            referralCommission2($user->id, $details);
            return ['error'=>false,'msg'=>'Buy Plan Success'];
        } catch (\Throwable $th) {
            return ['error'=>true, 'msg'=> 'Error: '.$th->getMessage()];
        }
      
        
    }

    public function sendPin(Request $request,$id){
         $validate = Validator::make($request->all(),[
            'pin'       => 'required|numeric|min:1',
        ]);
        if ($validate->fails()) {
           return redirect()->back()->withErrors($validate);
        }
        $user = User::find($id);
        $sponsor = Auth::user();
        $trx = getTrx();
        DB::beginTransaction();
        try {
            if ($sponsor->pin < $request->pin) {
                return ['error'=>true, 'msg'=> 'Not enough pin to send'];
            }
            $spin = UserPin::create([
                'user_id' => $sponsor->id,
                'pin'     => $request->pin,
                'pin_by'  => $user->id,
                'type'      => "-",
                'start_pin' => $sponsor->pin,
                'end_pin'   => $sponsor->pin - $request->pin,
                'ket'       => 'Sponsor Send '.$request->pin.' Pin to: '. $user->username
            ]);
            $sponsor->pin -= $request->pin;
            $sponsor->save();
            addToLog('Send '.$request->pin.' Pin to: '. $user->username);

            $upin = UserPin::create([
                'user_id' => $user->id,
                'pin'     => $request->pin,
                'pin_by'  => $sponsor->id,
                'start_pin' => $user->pin,
                'end_pin'   => $user->pin + $request->pin,
                'ket'       => 'Added '.$user->pin.' Pin By Sponsor: '. $sponsor->username
            ]);
           
            
            $user->pin += $request->pin;
            $user->save();
            
            // $transaction = new Transaction();
            // $transaction->user_id = $user->id;
            // $transaction->amount = $user->pin;
            // $transaction->post_balance = 0;
            // $transaction->charge = 0;
            // $transaction->trx_type = '+';
            // $transaction->details = 'Added Pin Via Admin';
            // $transaction->trx =  $trx;
            // $transaction->save();

            DB::commit();
            $notify[] = ['success','Send Pin Success to '.$user->username];
            return back()->withNotify($notify);
        } catch (\Throwable $th) {
            DB::rollBack();
            $notify[] = ['error', 'Error: '. $th->getMessage() ];
            return back()->withNotify($notify);
        }
         
    }


    public function convertSaldo(Request $request){
        $validate = Validator::make($request->all(),[
            "saldo" => "required|numeric",
            "qty" => "required|numeric",
            "idr" => "required|numeric",
            "sisa" => "required|numeric",
        ]);
        if ($validate->fails()) {
           return redirect()->back()->withInput($request->all())->withErrors($validate);
        }
        $user = Auth::user();
        $trx = getTrx();
        DB::beginTransaction();
        try {

            if ($user->balance < $request->idr) {
                return ['error'=>true, 'msg'=> 'Not enough balace to convert'];
            }

            $upin = UserPin::create([
                'user_id' => $user->id,
                'pin'     => $request->qty,
                'pin_by'  => null,
                'type'      => '+',
                'start_pin' => $user->pin,
                'end_pin'   => $user->pin + $request->qty,
                'ket'       => 'Convert '.$request->idr.' Balance To '.$request->qty.' Pin'
            ]);
           
            
            $user->pin += $request->qty;
            $user->balance -= $request->idr;
            $user->save();


            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $request->idr;
            $transaction->post_balance = $request->sisa;
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Convert '.$request->idr.' Balance To '.$request->qty.' Pin';
            $transaction->trx =  $trx;
            $transaction->save();


            DB::commit();
            addToLog('Convert '.$request->idr.' Balance To '.$request->qty.' Pin');
            
            $notify[] = ['success', 'Convert '.$request->idr.' Balance To '.$request->qty.' Pin'];
            return redirect()->back()->withNotify($notify);

        } catch (\Throwable $th) {
            DB::rollBack();
            $notify[] = ['success', 'Error: '.$th->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function userSendPin(){
        $data['page_title'] = "Send PINs";
        return view($this->activeTemplate . 'user.sendPin', $data);
    }
    public function findUname($uname){
        $find = User::where('username','=',$uname)->first();
       
        if(!$find){
            return response()->json(['status'=>404,'msg'=>"Username `".$uname."` Not Found!"]);
        }
        if($find->id == auth()->user()->id){
            return response()->json(['status'=>404,'msg'=>"Can't Send Pin To Yourself!"]);
        }
        return response()->json(['status'=>200,'msg'=>'Username Correct: `'.$find->username.' - '.$find->no_bro.'`','data'=>$find]);
    }

}
