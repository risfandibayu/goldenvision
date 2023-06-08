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
        $prod->type            = $request->type;
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
        $prod->reward           = $request->bonus;
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
    public function userReport(){
        $page_title = 'User Emas';
        $empty_message = 'No User Rewards Found';
        $table = UserExtra::userGold();

        $goldNow = DailyGold::orderByDesc('id')->first();
        // dd($table);
        return view('admin.bonus_reward.report_check', compact('page_title','table', 'empty_message','goldNow'));
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
