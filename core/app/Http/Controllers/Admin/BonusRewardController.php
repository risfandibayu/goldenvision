<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GoldExport;
use App\Models\corder;
use App\Http\Controllers\Controller;
use App\Models\BonusReward;
use App\Models\DailyGold;
use App\Models\GeneralSetting;
use App\Models\Gold;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\ureward;
use App\Models\User;
use App\Models\UserExtra;
use App\Models\UserGold;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use Maatwebsite\Excel\Facades\Excel;

class BonusRewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Bonus Rewards';
        $empty_message = 'No Bonus Rewards Found';
        $table = BonusReward::all()->paginate(getPaginate());
        $monthly = BonusReward::where('type','monthly')->orderByDesc('id')->get();
        return view('admin.bonus_reward.index', compact('page_title','table', 'empty_message','monthly'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SharingProvit()
    {
        $data['page_title'] = 'Sharing Provit';
        $data['empty_message'] = 'No Users Found';
        $data['table'] = User::where('sharing_profit',1)->paginate(getPaginate());
        $data['b'] = Carbon::create(2023, 5, 1)->startOfMonth()->diffInMonths(Carbon::now()->startOfMonth()) +1;
        $data['b2'] = getMonthArray();
        return view('admin.bonus_reward.sharing_provit', $data);
    }
    public function SharingProvitPost(Request $request){
        // update new user who qulified new left:right
        $user = User::join('user_extras','users.id','=','user_extras.user_id')
                ->where('users.sharing_profit',0)
                ->where('user_extras.left','>=',$request->kiri)
                ->where('user_extras.right','>=',$request->kanan)
                ->where('users.id','!=',130) //masterplan16
                ->update(['sharing_profit'=>1]); //update
        
        // find all user where sharing_profit = 1;
        $sharing = User::where('sharing_profit',1)->get();
        $count = $sharing->count();
        foreach ($sharing as $key => $user) {

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $request->amount;
            $transaction->post_balance = $user->balance + $request->amount;
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->details = $request->ket;
            $transaction->remark = 'profit_sharing';
            $transaction->trx =  getTrx();
            $transaction->save();

            $user->balance += $request->amount;
            $user->save();
        }
        $notify[] = ['success', 'Send Profit Sharing ' . $request->amount . ' to '. $count . ' users' ];
        return redirect()->back()->withNotify($notify);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $prod = new BonusReward();
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$prod->name)) . '.jpg';
            $location = 'assets/images/reward/' . $filename;
            $prod->images = $filename;

            $path = './assets/images/reward/';

            $link = $path . $prod->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }

        // dd($request->file('images'));
        $prod->kiri            = $request->kiri;
        $prod->kanan           = $request->kanan;
        $prod->reward          = $request->bonus;
        $prod->type            = 'monthly';
        $prod->status          = 0;
        $prod->save();

        $notify[] = ['success', 'New Reward created successfully'];
        return back()->withNotify($notify);
    }

    public function monthly(Request $request){

        DB::beginTransaction();
        try {
            // update last active to deactive
            BonusReward::where(['type'=>'monthly','status'=>1])->update(['status'=>0]);
            // update new monthly to active
            BonusReward::find($request->id)->update(['status'=>1]);
            // reset userExtra p_kanan && p_kiri to 0
            $ux =  UserExtra::where('p_left','!=',0)->orWhere('p_right','!=',0)->get();
            foreach ($ux as $key => $value) {
                $value->update(['p_left'=>0,'p_right'=>0]);
            }
            DB::commit();
            $notify[] = ['success', 'New Bonus Monthly updated successfully'];
            return back()->withNotify($notify);
        } catch (\Throwable $th) {
            DB::rollBack();
            $notify[] = ['error', 'Error: '.$th->getMessage()];
            return back()->withNotify($notify);
        }
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
    public function upreward(Request $request)
    {
        //
        // dd($request->all());
        $prod = BonusReward::find($request->id);
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$prod->name)) . '.jpg';
            $location = 'assets/images/reward/' . $filename;
            $prod->images = $filename;

            $path = './assets/images/reward/';

            $link = $path . $prod->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }

        // dd($request->file('images'));
        $prod->kiri            = $request->kiri;
        $prod->kanan           = $request->kanan;
        $prod->reward          = $request->bonus;
        $prod->type            = $request->type;
        $prod->status          = $request->status;
        $prod->save();

        $notify[] = ['success', 'New Reward updated successfully'];
        return back()->withNotify($notify);
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

    public function UserBonus(){
        $page_title = 'User Rewards';
        $empty_message = 'No User Rewards Found';
        $table = ureward::with('user')->orderBy('status','ASC')->paginate(getPaginate());
    // dd($table);
        return view('admin.bonus_reward.user', compact('page_title','table', 'empty_message'));
    }

    public function phone(){
        $page_title = 'Phone Rewards';
        $empty_message = 'No User Rewards Found';
        $table = ureward::with('user')->where('reward_id',3)->orderBy('status','ASC')->paginate(getPaginate());
    // dd($table);
        return view('admin.bonus_reward.reward', compact('page_title','table', 'empty_message'));
    }
    public function thai(){
        $page_title = 'Trip to Bangkok';
        $empty_message = 'No User Rewards Found';
        $table = ureward::with('user')->where('reward_id',4)->orderBy('status','ASC')->paginate(getPaginate());
    // dd($table);
        return view('admin.bonus_reward.reward', compact('page_title','table', 'empty_message'));
    }
    public function turkie(){
        $page_title = 'Trip to Turkie';
        $empty_message = 'No User Rewards Found';
        $table = ureward::with('user')->where('reward_id',1)->orderBy('status','ASC')->paginate(getPaginate());
    // dd($table);
        return view('admin.bonus_reward.reward', compact('page_title','table', 'empty_message'));
    }

    public function userReport(){
        $page_title = 'User Emas';
        $empty_message = 'No User Rewards Found';
        // $table = UserExtra::userGold();

        // $goldNow = DailyGold::orderByDesc('id')->first();
        $table = DB::table('user_extras as x')
            ->join('users as u', 'x.user_id', '=', 'u.id')
            ->select(
                'x.user_id',
                'u.username',
                DB::raw('COALESCE(JSON_UNQUOTE(JSON_EXTRACT(mark_lf, "$.left")), 0) AS left_value'),
                DB::raw('COALESCE(JSON_UNQUOTE(JSON_EXTRACT(mark_lf, "$.right")), 0) AS right_value'),
                'x.left AS left_now',
                'x.right AS right_now',
                DB::raw('x.left - COALESCE(JSON_UNQUOTE(JSON_EXTRACT(mark_lf, "$.left")), 0) AS grow_left'),
                DB::raw('x.right - COALESCE(JSON_UNQUOTE(JSON_EXTRACT(mark_lf, "$.right")), 0) AS grow_right')
            )
            ->whereRaw('x.left - COALESCE(JSON_UNQUOTE(JSON_EXTRACT(mark_lf, "$.left")), 0) > 0')
            ->whereRaw('x.right - COALESCE(JSON_UNQUOTE(JSON_EXTRACT(mark_lf, "$.right")), 0) > 0')
            ->whereNotIn('u.firstname', ['masterplan', 'ptmmi'])
            ->orderByDesc('grow_left')
            ->orderByDesc('grow_right')
            ->paginate();
        // dd($table);
        return view('admin.bonus_reward.report_check', compact('page_title','table', 'empty_message'));
    }

    public function memberGrow(){
    // dd(memberGrowId(1));
        $page_title = 'Member Grow';
        $empty_message = 'No User Rewards Found';
        $table =  User::where('sharing_profit',1)->get();
        // dd($table);
        return view('admin.bonus_reward.member_grow', compact('page_title','table', 'empty_message'));
    }
    // public function

    public function goldUserExport(){
        return Excel::download(new GoldExport, 'gold-users.xlsx');
    }
    public function UserUpdate(Request $request){
        // dd($request->all());
        $user = User::find($request->user);
        if(!$user){
            $notify[] = ['error', 'Error: User Not Found'];
            return back()->withNotify($notify);
        }
        DB::beginTransaction();
        try {
            ureward::find($request->id)->update([
                'ket'       => $request->ket,
                'status'    => $request->status
            ]);
            // if($request->claim == 'equal'){
            //     $transaction = new Transaction();
            //     $transaction->user_id = $user->id;
            //     $transaction->amount = $request->amount;
            //     $transaction->post_balance = $user->balance + $request->amount;
            //     $transaction->charge = 0;
            //     $transaction->trx_type = '+';
            //     $transaction->details = 'Claim Bonus Monthly, Equal Money';
            //     $transaction->trx =  getTrx();
            //     $transaction->save();

            //     $user->balance += $request->amount;
            //     $user->save();
            // }

            DB::commit();
            $notify[] = ['success', 'Data Updated'];
            return back()->withNotify($notify);
        } catch (\Throwable $th) {
            DB::rollBack();
            $notify[] = ['error', 'Error: '.$th->getMessage()];
            return back()->withNotify($notify);
        }

        
       
    }
}
