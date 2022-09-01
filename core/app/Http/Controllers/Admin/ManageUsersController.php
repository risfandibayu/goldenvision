<?php
namespace App\Http\Controllers\Admin;

use App\Exports\ExportUser;
use App\Exports\ExptUserGold;
use App\Exports\ExptUserQuery;
use App\Exports\ExptUserQueryPage;
use App\Exports\ExptUserView;
use App\Models\Deposit;
use App\Models\BvLog;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Gold;
use App\Models\SupportTicket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Survey;
use App\Models\UserExtra;
use App\Models\WithdrawMethod;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ManageUsersController extends Controller
{
    public function allUsers()
    {
        $page_title = 'Manage Users';
        $empty_message = 'No user found';
        $users = User::latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }

    public function exportallUsers(Request $request){
        if ($request->search) {
            return Excel::download(new ExptUserQuery($request->search), 'users.xlsx');
            # code...
        }else{
            if ($request->page != "Manage Users") {
                # code...
                // return Excel::download(new ExportUser, 'users.xlsx');
                // dd('s');
                if ($request->page == "Manage Active Users") {
                $q = User::query()->active()->latest()->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email');
                return Excel::download(new ExptUserQueryPage($q), 'users.xlsx');
                }

                if ($request->page == "Banned Users") {
                $q = User::query()->banned()->latest()->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email');
                return Excel::download(new ExptUserQueryPage($q), 'users.xlsx');
                }

                if ($request->page == "Verified Data Users") {
                $q = User::query()->where('is_kyc','2')->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email');
                return Excel::download(new ExptUserQueryPage($q), 'users.xlsx');
                }

                if ($request->page == "Waiting For Verification Data Users") {
                $q = User::query()->where('is_kyc','1')->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email');
                return Excel::download(new ExptUserQueryPage($q), 'users.xlsx');
                }

                if ($request->page == "Email Unverified Users") {
                $q = User::query()->emailUnverified()->latest()->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email');
                return Excel::download(new ExptUserQueryPage($q), 'users.xlsx');
                }

                if ($request->page == "Email Verified Users") {
                $q = User::query()->emailVerified()->latest()->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email');
                return Excel::download(new ExptUserQueryPage($q), 'users.xlsx');
                }

                if ($request->page == "Rejected Data Users") {
                $q = User::query()->where('is_kyc','3')->select(db::raw("CONCAT(firstname, ' ',lastname ) AS nama"),'username','no_bro','email');
                return Excel::download(new ExptUserQueryPage($q), 'users.xlsx');
                }


            }else{
                return Excel::download(new ExportUser, 'users.xlsx');
            }

        }
        // dd($request->page);
    }

    public function activeUsers()
    {
        $page_title = 'Manage Active Users';
        $empty_message = 'No active user found';
        $users = User::active()->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }

    public function bannedUsers()
    {
        $page_title = 'Banned Users';
        $empty_message = 'No banned user found';
        $users = User::banned()->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }
    public function rejectDataUsers()
    {
        $page_title = 'Rejected Data Users';
        $empty_message = 'No rejected user found';
        $users = User::where('is_kyc','3')->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }
    public function verifiedDataUsers()
    {
        $page_title = 'Verified Data Users';
        $empty_message = 'No Verified user found';
        $users = User::where('is_kyc','2')->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }
    public function verificationDataUsers()
    {
        $page_title = 'Waiting For Verification Data Users';
        $empty_message = 'No Data user found';
        $users = User::where('is_kyc','1')->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }

    public function emailUnverifiedUsers()
    {
        $page_title = 'Email Unverified Users';
        $empty_message = 'No email unverified user found';
        $users = User::emailUnverified()->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }
    public function emailVerifiedUsers()
    {
        $page_title = 'Email Verified Users';
        $empty_message = 'No email verified user found';
        $users = User::emailVerified()->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }


    // public function smsUnverifiedUsers()
    // {
    //     $page_title = 'SMS Unverified Users';
    //     $empty_message = 'No sms unverified user found';
    //     $users = User::smsUnverified()->latest()->paginate(getPaginate());
    //     return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    // }
    // public function smsVerifiedUsers()
    // {
    //     $page_title = 'SMS Verified Users';
    //     $empty_message = 'No sms verified user found';
    //     $users = User::smsVerified()->latest()->paginate(getPaginate());
    //     return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    // }



    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $users = User::where(function ($user) use ($search) {
            $user->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('no_bro', 'like', "%$search%")
                ->orWhere('mobile', 'like', "%$search%")
                ->orWhere('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%");
        });
        $page_title = '';
        switch ($scope) {
            case 'active':
                $page_title .= 'Active ';
                $users = $users->where('status', 1);
                break;
            case 'banned':
                $page_title .= 'Banned';
                $users = $users->where('status', 0);
                break;
            case 'emailUnverified':
                $page_title .= 'Email Unerified ';
                $users = $users->where('ev', 0);
                break;
            case 'smsUnverified':
                $page_title .= 'SMS Unverified ';
                $users = $users->where('sv', 0);
                break;
        }
        $users = $users->paginate(getPaginate());
        $page_title .= 'User Search - ' . $search;
        $empty_message = 'No search result found';
        return view('admin.users.list', compact('page_title', 'search', 'scope', 'empty_message', 'users'));
    }


    public function detail($id)
    {
        $page_title         = 'User Detail';
        $user               = User::where('id', $id)->with('userExtra')->first();
        $ref_id             = User::find($user->ref_id);
        $totalDeposit       = Deposit::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalWithdraw      = Withdrawal::where('user_id',$user->id)->where('status',1)->sum('amount');
        $totalTransaction   = Transaction::where('user_id',$user->id)->count();

        $totalBvCut         = BvLog::where('user_id',$user->id)->where('trx_type', '-')->sum('amount');
        
        $emas               = Gold::where('user_id',$user->id)->join('products','products.id','=','golds.prod_id')->select('golds.*',db::raw('COALESCE(SUM(products.price * golds.qty),0) as total_rp'),db::raw('COALESCE(sum(products.weight * golds.qty ),0) as total_wg'))->groupBy('golds.user_id')->first();
        return view('admin.users.detail', compact('page_title','ref_id','user','totalDeposit',
            'totalWithdraw','totalTransaction',  'totalBvCut','emas'));
    }

    public function goldDetail($id){
        $user = user::where('id',$id)->first();
        $page_title         = 'Gold Invest Detail : '.$user->username;
        $empty_message = 'Gold Invest Not found.';
        $gold  = Gold::where('user_id',$id)->where('golds.qty','!=',0)->join('products','products.id','=','golds.prod_id')->select('products.*','golds.qty',db::raw('SUM(products.price * golds.qty) as total_rp'),db::raw('sum(products.weight * golds.qty ) as total_wg'))->groupBy('golds.prod_id')
        ->paginate(getPaginate());
        return view('admin.users.gold',compact('page_title', 'empty_message','gold'));
        // return view('admin.users.gold',compact('page_title','emas'))
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
            'email' => 'required|email|max:160|unique:users,email,' . $user->id,
        ]);

        if ($request->email != $user->email && User::whereEmail($request->email)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Email already exists.'];
            return back()->withNotify($notify);
        }
        if ($request->mobile != $user->mobile && User::where('mobile', $request->mobile)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Phone number already exists.'];
            return back()->withNotify($notify);
        }

        $user->mobile = $request->mobile;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->address = [
                            'address' => $request->address,
                            'city' => $request->city,
                            'state' => $request->state,
                            'zip' => $request->zip,
                            'country' => $request->country,
                        ];
        $user->status = $request->status ? 1 : 0;
        $user->ev = $request->ev ? 1 : 0;
        $user->sv = $request->sv ? 1 : 0;
        $user->ts = $request->ts ? 1 : 0;
        $user->tv = $request->tv ? 1 : 0;
        $user->save();

        $notify[] = ['success', 'User detail has been updated'];
        return redirect()->back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $user = User::findOrFail($id);
        $amount = getAmount($request->amount);
        $general = GeneralSetting::first(['cur_text','cur_sym']);
        $trx = getTrx();

        if ($request->act) {
            $user->balance += $amount;
            $user->save();
            $notify[] = ['success', $general->cur_sym . $amount . ' has been added to ' . $user->username . ' balance'];


            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = getAmount($user->balance);
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->details = 'Added Balance Via Admin';
            $transaction->trx =  $trx;
            $transaction->save();


            notify($user, 'BAL_ADD', [
                'trx' => $trx,
                'amount' => $amount,
                'currency' => $general->cur_text,
                'post_balance' => getAmount($user->balance),
            ]);

        } else {
            if ($amount > $user->balance) {
                $notify[] = ['error', $user->username . ' has insufficient balance.'];
                return back()->withNotify($notify);
            }
            $user->balance -= $amount;
            $user->save();



            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = getAmount($user->balance);
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Subtract Balance Via Admin';
            $transaction->trx =  $trx;
            $transaction->save();


            notify($user, 'BAL_SUB', [
                'trx' => $trx,
                'amount' => $amount,
                'currency' => $general->cur_text,
                'post_balance' => getAmount($user->balance)
            ]);
            $notify[] = ['success', $general->cur_sym . $amount . ' has been subtracted from ' . $user->username . ' balance'];
        }
        return back()->withNotify($notify);
    }

    public function userLoginHistory($id)
    {
        $user = User::findOrFail($id);
        $page_title = 'User Login History - ' . $user->username;
        $empty_message = 'No users login found.';
        $login_logs = $user->login_logs()->latest()->paginate(getPaginate());
        return view('admin.users.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function userRef($id)
    {

        $empty_message = 'No user found';
        $user = User::findOrFail($id);
        $page_title = 'Referred By ' . $user->username;
        $users = User::where('ref_id', $id)->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }

    public function showEmailSingleForm($id)
    {
        $user = User::findOrFail($id);
        $page_title = 'Send Email To: ' . $user->username;
        return view('admin.users.email_single', compact('page_title', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = User::findOrFail($id);
        sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function transactions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Transactions : ' . $user->username;
            $transactions = $user->transactions()->where('trx', $search)->with('user')->latest()->paginate(getPaginate());
            $empty_message = 'No transactions';
            return view('admin.reports.transactions', compact('page_title', 'search', 'user', 'transactions', 'empty_message'));
        }
        $page_title = 'User Transactions : ' . $user->username;
        $transactions = $user->transactions()->with('user')->latest()->paginate(getPaginate());
        $empty_message = 'No transactions';
        return view('admin.reports.transactions', compact('page_title', 'user', 'transactions', 'empty_message'));
    }

    public function deposits(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $userId = $user->id;
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Deposits : ' . $user->username;
            $deposits = $user->deposits()->where('trx', $search)->latest()->paginate(getPaginate());
            $empty_message = 'No deposits';
            return view('admin.deposit.log', compact('page_title', 'search', 'user', 'deposits', 'empty_message','userId'));
        }

        $page_title = 'User Deposit : ' . $user->username;
        $deposits = $user->deposits()->latest()->paginate(getPaginate());
        $empty_message = 'No deposits';
        $scope = 'all';
        return view('admin.deposit.log', compact('page_title', 'user', 'deposits', 'empty_message','userId','scope'));
    }


    public function depViaMethod($method,$type = null,$userId){
        $method = Gateway::where('alias',$method)->firstOrFail();
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $page_title = 'Approved Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 1)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $page_title = 'Rejected Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 3)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'successful'){
            $page_title = 'Successful Payment Via '.$method->name;
            $deposits = Deposit::where('status', 1)->where('user_id',$user->id)->where('method_code',$method->code)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }elseif($type == 'pending'){
            $page_title = 'Pending Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('user_id',$user->id)->where('method_code',$method->code)->where('status', 2)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }else{
            $page_title = 'Payment Via '.$method->name;
            $deposits = Deposit::where('status','!=',0)->where('user_id',$user->id)->where('method_code',$method->code)->latest()->with(['user', 'gateway'])->paginate(getPaginate());
        }
        $page_title = 'Deposit History: '.$user->username.' Via '.$method->name;
        $methodAlias = $method->alias;
        $empty_message = 'Deposit Log';
        return view('admin.deposit.log', compact('page_title', 'empty_message', 'deposits','methodAlias','userId'));
    }



    public function withdrawals(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Withdrawals : ' . $user->username;
            $withdrawals = $user->withdrawals()->where('trx', 'like',"%$search%")->latest()->paginate(getPaginate());
            $empty_message = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'search', 'withdrawals', 'empty_message'));
        }
        $page_title = 'User Withdrawals : ' . $user->username;
        $withdrawals = $user->withdrawals()->latest()->paginate(getPaginate());
        $empty_message = 'No withdrawals';
        $userId = $user->id;
        return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'withdrawals', 'empty_message','userId'));
    }

    public  function withdrawalsViaMethod($method,$type,$userId){
        $method = WithdrawMethod::findOrFail($method);
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $page_title = 'Approved Withdrawal of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 1)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());
        }elseif($type == 'rejected'){
            $page_title = 'Rejected Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 3)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());

        }elseif($type == 'pending'){
            $page_title = 'Pending Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 2)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());
        }else{
            $page_title = 'Withdrawals of '.$user->username.' Via '.$method->name;
            $withdrawals = Withdrawal::where('status', '!=', 0)->where('user_id',$user->id)->with(['user','method'])->latest()->paginate(getPaginate());
        }
        $empty_message = 'Withdraw Log Not Found';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message','method'));
    }

    public function showEmailAllForm()
    {
        $page_title = 'Send Email To All Users';
        return view('admin.users.email_all', compact('page_title'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (User::where('status', 1)->cursor() as $user) {
            sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All users will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function tree($username){

        $user = User::where('username',$username)->first();

        if($user){
            $data['tree'] = showTreePage($user->id);
            $data['page_title'] = "Tree of ".$user->fullname;
            return view( 'admin.users.tree', $data);
        }

        $notify[] = ['error', 'Tree Not Found!!'];
        return redirect()->route('admin.dashboard')->withNotify($notify);

    }

    public function otherTree(Request $request, $username = null)
    {
        if ($request->username) {
            $user = User::where('username', $request->username)->first();
        } else {
            $user = User::where('username', $username)->first();
        }
        if ($user) {
            $data['tree'] = showTreePage($user->id);
            $data['page_title'] = "Tree of " . $user->fullname;
            return view( 'admin.users.tree', $data);
        }

        $notify[] = ['error', 'Tree Not Found!!'];
        return redirect()->route('admin.dashboard')->withNotify($notify);
    }

    public function survey($id){
        $user = User::findOrFail($id);
        $page_title = 'User Completed Survey : '.$user->username;
        $empty_message = 'No completed survey found';
        $all_survey = Survey::whereJsonContains('users', $user->id)->orderBy('last_report', 'DESC')->paginate(getPaginate());
        return view('admin.survey.report', compact('page_title','all_survey','empty_message', 'id'));
    }

    public function login($id){
        $user = User::findOrFail($id);
        Auth::login($user);
        return redirect()->route('user.home');
    }

    public function verify($id){
        $user = User::findOrFail($id);
        $user->is_kyc = 2;
        $user->save();
        $notify[] = ['success', 'User successfully verify!!'];
        return back()->withNotify($notify);
    }
    public function reject($id){
        $user = User::findOrFail($id);
        $user->is_kyc = 3;
        $user->save();
        $notify[] = ['success', 'User successfully rejected!!'];
        return back()->withNotify($notify);
    }

    public function setUserPlacement($id,Request $request){
        // dd($request->all());
        $user = user::where('id',$id)->first();
        $userextra = UserExtra::where('user_id',$id)->first();
        $uplineextra = UserExtra::where('user_id',$user->pos_id)->first();
        $parent = user::where('no_bro',$request->no_bro)->first();
        $parentextra = UserExtra::where('user_id',$parent->id)->first();
        //bro tidak ditemukan
        if (!$parent) {
            $notify[] = ['error', 'BRO number not found'];
            return back()->withNotify($notify);
        }

        $lparent = user::where('pos_id',$parent->id)->where('position',1)->first();
        $rparent = user::where('pos_id',$parent->id)->where('position',2)->first();

        //slot penuh
        if ($lparent && $rparent) {
            # code...
            $notify[] = ['error', 'BRO number has not empty slot'];
            return back()->withNotify($notify);
        }

        //kiri penuh
        if ($lparent && $request->position == 1) {
            # code...
            $notify[] = ['error', 'Left slot BRO number has not empty'];
            return back()->withNotify($notify);
        }

        //kanan penuh
        if ($rparent && $request->position == 2) {
            # code...
            $notify[] = ['error', 'Right slot BRO number has not empty'];
            return back()->withNotify($notify);
        }



        // if ($request->position == 1) {
        //     # code...

        //     $parentextra->paid_left += ($userextra->paid_left + $userextra->paid_right) + 1;
        //     $parentextra->left += ($userextra->left + $userextra->right) + 1;
        //     $parentextra->save();

        // }

        // if ($request->position == 2) {
        //     # code...
        //     $parentextra->paid_right += ($userextra->paid_left + $userextra->paid_right) + 1;
        //     $parentextra->right += ($userextra->left + $userextra->right) + 1;
        //     $parentextra->save();

        // }



        if ($user->position == 1) {
            # code...
            $uplineextra->paid_left -= ($userextra->paid_left + $userextra->paid_right) + 1;
            $uplineextra->left -= ($userextra->left + $userextra->right) + 1;
            $uplineextra->save();

        }

        if ($user->position == 2) {
            # code...
            $uplineextra->paid_right -= ($userextra->paid_left + $userextra->paid_right) + 1;
            $uplineextra->right -= ($userextra->left + $userextra->right) + 1;
            $uplineextra->save();

        }



        $user->pos_id = $parent->id;
        $user->position = $request->position;
        $user->save();
        updatePaidCount3($user->id);


        $notify[] = ['success', 'The user has successfully changed his placement'];
        return back()->withNotify($notify);
    }

    public function userGold(Request $request){
        if ($request->search) {
            $search = $request->search;
            $page_title = 'User Golds';
            $empty_message = 'No user found';
            $users = User::join('golds','golds.user_id','=','users.id')->join('products','products.id','=','golds.prod_id')
            ->where('users.email', 'like',"%$search%")
            ->Orwhere('users.username', 'like',"%$search%")
            ->select('users.id as id','users.username as username', 'users.firstname as fr','users.lastname as ls', 'users.email as email', db::raw('sum(products.weight * golds.qty) as emas'))
            ->groupby('users.id')
            ->paginate(getPaginate());

            // dd($users);
            return view('admin.users.gd', compact('page_title','search', 'empty_message', 'users'));
        }
        $page_title = 'User Golds';
        $empty_message = 'No user found';
        $users = User::join('golds','golds.user_id','=','users.id')->join('products','products.id','=','golds.prod_id')
        ->select('users.id as id','users.username as username', 'users.firstname as fr','users.lastname as ls', 'users.email as email', db::raw('sum(products.weight * golds.qty) as emas'))
        ->groupby('users.id')
        ->paginate(getPaginate());

        // dd($users);
        return view('admin.users.gd', compact('page_title', 'empty_message', 'users'));
    }

    public function exportUserGold(Request $request){
        if ($request->search) {
            # code...
            $search = $request->search;
            return Excel::download(new ExptUserGold(User::query()->join('golds','golds.user_id','=','users.id')->join('products','products.id','=','golds.prod_id')
            ->where('users.email', 'like',"%$search%")
            ->Orwhere('users.username', 'like',"%$search%")
            ->select('users.id as id','users.username as username', db::raw("CONCAT(users.firstname, ' ',users.lastname ) AS nama"), 'users.email as email', db::raw('sum(products.weight * golds.qty) as emas'))
            ->groupby('users.id')), 'users_golds.xlsx');
        }else{
            return Excel::download(new ExptUserGold(User::query()->join('golds','golds.user_id','=','users.id')->join('products','products.id','=','golds.prod_id')
            ->select('users.username as username', db::raw("CONCAT(users.firstname, ' ',users.lastname ) AS nama"), 'users.email as email', db::raw('sum(products.weight * golds.qty) as emas'))
            ->groupby('users.id')), 'users_golds.xlsx');
        }
    }


}

