<?php

namespace App\Http\Controllers;

use App\Models\DailyGold;
use App\Models\GeneralSetting;
use App\Models\MemberGrow;
use App\Models\rekening;
use App\Models\SilverCheck;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use App\Models\WeeklyGold;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\New_;
use Weidner\Goutte\GoutteFacade;

class CronController extends Controller
{
    public function weeklyGold(){
        $last = WeeklyGold::orderByDesc('id')->first();
        $wk =  WeeklyGold::create([
                'per_gram' => 0.005,
                'week' => !$last?1:$last->week+1,
            ]);
        return ['status'=>'success','data'=>$wk];
    }

    public function cronNew(){
        $gnl = GeneralSetting::first();
        $gnl->last_cron = Carbon::now()->toDateTimeString();
		$gnl->save();
        $userx = UserExtra::where('paid_left','>=',1)->where('paid_left','>=',1)->get();
        $cron = [];
        foreach($userx as $ux){
    
            $user_plan = user::where('users.id',$ux->user_id)
                    ->join('plans','plans.id','=','users.plan_id')
                    ->where('users.plan_id','!=',0)->first(); 

            // checkStartDayPair;
            if(Date('H') == "00"){
                $ux->limit = 0;
                $ux->last_flush_out = null;
                $ux->save();
            }
            
            
            $growLeft = $ux->paid_left; //25
            $growRight = $ux->paid_right; //24
            
            $pairID = $growLeft < $growRight ? $growLeft : $growRight; //24

            
            $payout = $this->setPayout($pairID,20);

            if($payout['pay'] != 0 && $ux->last_flush_out == null){

                $pairID = $payout['pay'];

                $ux->paid_left -= $pairID;
                $ux->paid_right -= $pairID;
                $ux->level_binary = 0;
                $ux->limit += $pairID;
                $ux->last_getcomm = Carbon::now()->toDateTimeString();
                $ux->save();

                $gnl->last_paid = Carbon::now()->toDateTimeString();
                $gnl->save();


                $bonus = intval(($pairID) * ($user_plan->tree_com * 2));
                $payment = User::find($ux->user_id);
                $payment->balance += $bonus;
                $payment->total_binary_com += $bonus;
                $payment->save();

                $trx = new Transaction();
                $trx->user_id = $payment->id;
                $trx->amount = $bonus;
                $trx->charge = 0;
                $trx->trx_type = '+';
                $trx->post_balance = $payment->balance;
                $trx->remark = 'binary_commission';
                $trx->trx = getTrx();
                $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pairID * 2 . ' MP.';
                $trx->save();

                $cron[] = $payment.'/'.$pairID.'/'.Carbon::parse($ux->last_flush_out)->format('Y-m-d').'/bonus='.$bonus;

                continue;
            }

            if ($payout['flashout'] != 0 || $ux->last_flush_out != null) {

                $payment = User::find($ux->user_id);
                $ux->last_flush_out = Carbon::now()->toDateTimeString();
                //if flashout left right counting as paid;
                $ux->paid_left -= $payout['flashout'];
                $ux->paid_right -= $payout['flashout'];
                $ux->save();
                $cron[] = $payment.'/'.Carbon::parse($ux->last_flush_out)->format('Y-m-d').'/flashout';

                continue;
            }
            

          
           
            
        }
        return $cron;
    }
    function setPayout($pay, $maxPay) {
        if ($pay > $maxPay) {
            $flashout = $pay - $maxPay;
            $pay = $maxPay;
        } else {
            $flashout = 0;
        }
        
        return array('pay' => $pay, 'flashout' => $flashout);
    }



    public function memberGrow(){
        $user = User::where('sharing_profit',1)->get();
        foreach ($user as $key => $value) {
            $late = MemberGrow::where('user_id',$value->userExtra->user_id)->first();
            $mm             = new MemberGrow();
            $mm->user_id    = $value->userExtra->user_id;
            $mm->left       = $value->userExtra->left;
            $mm->right      = $value->userExtra->right;
            $mm->grow_l     = $value->userExtra->left - ($late->left??0);
            $mm->grow_r     = $value->userExtra->right - ($late->right??0);
            $mm->save();
        }
        return 'success';
    }
    // public function cron()
    // {
    //     $gnl = GeneralSetting::first();
    //     $gnl->last_cron = Carbon::now()->toDateTimeString();
	// 	$gnl->save();

    //     if ($gnl->matching_bonus_time == 'daily') {
    //         $day = Date('H');
    //         if (strtolower($day) != $gnl->matching_when) {
    //             return '1';
    //         }
    //     }

    //     if ($gnl->matching_bonus_time == 'weekly') {
    //         $day = Date('D');
    //         if (strtolower($day) != $gnl->matching_when) {
    //             return '2';
    //         }
    //     }

    //     if ($gnl->matching_bonus_time == 'monthly') {
    //         $day = Date('d');
    //         if (strtolower($day) != $gnl->matching_when) {
    //             return '3';
    //         }
    //     }

    //     if (Carbon::now()->toDateString() == Carbon::parse($gnl->last_paid)->toDateString()) {
    //         /////// bv done for today '------'
    //         ///////////////////LETS PAY THE BONUS

    //         $gnl->last_paid = Carbon::now()->toDateString();
    //         $gnl->save();

    //         $eligibleUsers = UserExtra::where('bv_left', '>=', $gnl->total_bv)->where('bv_right', '>=', $gnl->total_bv)->get();

    //         foreach ($eligibleUsers as $uex) {
                // $user = $uex->user;
    //             $weak = $uex->bv_left < $uex->bv_right ? $uex->bv_left : $uex->bv_right;
    //             $weaker = $weak < $gnl->max_bv ? $weak : $gnl->max_bv;

    //             $pair = intval($weaker / $gnl->total_bv);

    //             $bonus = $pair * $gnl->bv_price;

    //             // add balance to User

    //             $payment = User::find($uex->user_id);
    //             $payment->balance += $bonus;
    //             $payment->save();

    //             $trx = new Transaction();
    //             $trx->user_id = $payment->id;
    //             $trx->amount = $bonus;
    //             $trx->charge = 0;
    //             $trx->trx_type = '+';
    //             $trx->post_balance = $payment->balance;
    //             $trx->remark = 'binary_commission';
    //             $trx->trx = getTrx();
    //             $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * $gnl->total_bv . ' BV.';
    //             $trx->save();

                // notify($user, 'matching_bonus', [
                //     'amount' => $bonus,
                //     'currency' => $gnl->cur_text,
                //     'paid_bv' => $pair * $gnl->total_bv,
                //     'post_balance' => $payment->balance,
                //     'trx' =>  $trx->trx,
                // ]);

    //             $paidbv = $pair * $gnl->total_bv;
    //             if ($gnl->cary_flash == 0) {
    //                 $bv['setl'] = $uex->bv_left - $paidbv;
    //                 $bv['setr'] = $uex->bv_right - $paidbv;
    //                 $bv['paid'] = $paidbv;
    //                 $bv['lostl'] = 0;
    //                 $bv['lostr'] = 0;
    //             }
    //             if ($gnl->cary_flash == 1) {
    //                 $bv['setl'] = $uex->bv_left - $weak;
    //                 $bv['setr'] = $uex->bv_right - $weak;
    //                 $bv['paid'] = $paidbv;
    //                 $bv['lostl'] = $weak - $paidbv;
    //                 $bv['lostr'] = $weak - $paidbv;
    //             }
    //             if ($gnl->cary_flash == 2) {
    //                 $bv['setl'] = 0;
    //                 $bv['setr'] = 0;
    //                 $bv['paid'] = $paidbv;
    //                 $bv['lostl'] = $uex->bv_left - $paidbv;
    //                 $bv['lostr'] = $uex->bv_right - $paidbv;
    //             }
    //             $uex->bv_left = $bv['setl'];
    //             $uex->bv_right = $bv['setr'];
    //             $uex->save();


    //             if ($bv['paid'] != 0) {
    //                 createBVLog($user->id, 1, $bv['paid'], 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
    //                 createBVLog($user->id, 2, $bv['paid'], 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
    //             }
    //             if ($bv['lostl'] != 0) {
    //                 createBVLog($user->id, 1, $bv['lostl'], 'Flush ' . $bv['lostl'] . ' BV after Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
    //             }
    //             if ($bv['lostr'] != 0) {
    //                 createBVLog($user->id, 2, $bv['lostr'], 'Flush ' . $bv['lostr'] . ' BV after Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
    //             }
    //         }
    //         return '---';
    //     }
    // }

    public function monolegSaving(){
        $gnl = GeneralSetting::first();
        // $gnl->last_cron = Carbon::now()->toDateTimeString();
		// $gnl->save();
        $userx = UserExtra::where('is_gold','=',1)->where('monoleg_downline','!=',0)->get();

        // dd($userx);
        $cron = array();
        foreach ($userx as $uex) {
            $bonus = $uex->monoleg_downline;

            $payment = User::find($uex->user_id);
            $payment->balance += $bonus;
            $payment->save();

            $trx = new Transaction();
            $trx->user_id = $payment->id;
            $trx->amount = $bonus;
            $trx->charge = 0;
            $trx->trx_type = '+';
            $trx->post_balance = $payment->balance;
            $trx->remark = 'monoleg_commission_downline';
            $trx->trx = getTrx();
            $trx->details = 'Paid Monoleg Commission from downline : ' . $bonus . ' ' . $gnl->cur_text;
            $trx->save();            
            
            $uex->monoleg_downline = 0;
            $uex->save();

            $cron[] = $uex->user_id.'/'.$bonus;
        }

        return $cron;
    }


    public function monoleg(){
        $gnl = GeneralSetting::first();
        // $gnl->last_cron = Carbon::now()->toDateTimeString();
		// $gnl->save();
        $userx = UserExtra::where('is_gold','=',1)->get();
        // dd($userx);
        $cron = array();
        foreach ($userx as $uex) {
            $user = $uex->user_id;
            $strong = $uex->paid_left > $uex->paid_right ? $uex->paid_left : $uex->paid_right;
            $weak = $uex->paid_left < $uex->paid_right ? $uex->paid_left : $uex->paid_right;
            $strong_text = $uex->paid_left > $uex->paid_right ? 'kiri' : 'kanan';
            // $pair = intval($strong);
            // $users = user::where('ref_id',$user)->where('position',2)->first();
            $posid = getRefId($user);
            $posUser = UserExtra::where('user_id',$posid)->first();
            $username = User::where('id',$user)->first();


            $count = countingQ($user);
            if ($count > 0) {
                    if(empty($uex->strong_leg)){
                        if ($strong > 4) {
                            if ($strong > 0 && $strong <= 100) {
                                $bonus = (($strong-4)*5000)/countingQ($user) ;
                            }

                            $flushOut = '';
                            if ($bonus > 2500000) {
                                if (($strong - $uex->monoleg_left) - userRefaDay($uex->user_id) == 0 ) {
                                    $flushOut = '(Flush Out)';
                                    $bonus = 2500000;
                                }
                            }
                            
                            $payment = User::find($uex->user_id);
                            $payment->balance += $bonus;
                            $payment->save();

                            $trx = new Transaction();
                            $trx->user_id = $payment->id;
                            $trx->amount = $bonus;
                            $trx->charge = 0;
                            $trx->trx_type = '+';
                            $trx->post_balance = $payment->balance;
                            $trx->remark = 'monoleg_commission';
                            $trx->trx = getTrx();
                            $trx->details = 'Paid Monoleg Commission First '. ($strong - 4 - $uex->monoleg_left) .' feet : ' . $bonus . ' ' . $gnl->cur_text;
                            $trx->save();

                            if($strong_text == 'kiri'){
                                $uex->strong_leg = $strong_text;
                                $uex->monoleg_left = $strong;
                                $uex->save();
                            }else{
                                $uex->strong_leg = $strong_text;
                                $uex->monoleg_right = $strong;
                                $uex->save();
                            }

                            monolegSaving($uex->user_id,$bonus,$username->username,'first');

                            $cron[] = $user.'/'.$count.'/'.$strong.'/'.$strong_text.'/'.$bonus.'/first';
                        }

                    }else{
                        if ($strong_text == 'kiri') {
                            if (($strong - $uex->monoleg_left) > 0) {
                                if ($strong > 0 && $strong <= 100) {
                                    $bonus = (($strong - $uex->monoleg_left)*5000)/countingQ($user) ;
                                }elseif ($strong > 100 && $strong <= 15000){
                                    if ($strong > 100 && $weak > 100){
                                        $bonus = (($strong - $uex->monoleg_left)*15000)/countingQ($user) ;
                                    }else{
                                        $bonus = (($strong - $uex->monoleg_left)*10000)/countingQ($user) ;
                                    }
                                }elseif ($strong > 15000 ){
                                    $bonus = (($strong - $uex->monoleg_left)*20000)/countingQ($user) ;
                                }

                                $flushOut = '';
                                if ($bonus > 2500000) {
                                    if (($strong - $uex->monoleg_left) - userRefaDay($uex->user_id) == 0 ) {
                                        $flushOut = '(Flush Out)';
                                        $bonus = 2500000;
                                    }
                                }
                            
                                // $payment = User::find($uex->user_id);
                                // $payment->balance += $bonus;
                                // $payment->save();

                                // $trx = new Transaction();
                                // $trx->user_id = $payment->id;
                                // $trx->amount = $bonus;
                                // $trx->charge = 0;
                                // $trx->trx_type = '+';
                                // $trx->post_balance = $payment->balance;
                                // $trx->remark = 'monoleg_commission';
                                // $trx->trx = getTrx();
                                // $trx->details = $flushOut.' Paid Monoleg Commission '.($strong - $uex->monoleg_left).' feet : ' . $bonus . ' ' . $gnl->cur_text;
                                // $trx->save();

                                $uex->strong_leg = $strong_text;
                                $uex->monoleg_left = $strong;
                                $uex->save();

                                // monolegSaving($uex->user_id,$bonus,$username->username,'kiri');

                                $cron[] = $user.'/'.$count.'/'.$strong.'/'.$strong_text.'/'.$bonus.'/second';
                                // $cron[] = $user.'/'.$count.'/'.$strong.'/'.$strong_text.'/second';
                            }
                        }else{
                            if (($strong - $uex->monoleg_right) > 0) {
                                if ($strong > 0 && $strong < 100) {
                                    $bonus = (($strong - $uex->monoleg_right)*5000)/countingQ($user) ;
                                }elseif ($strong > 100 && $strong <= 15000){
                                    if ($strong > 100 && $weak > 100){
                                        $bonus = (($strong - $uex->monoleg_right)*15000)/countingQ($user) ;
                                    }else{
                                        $bonus = (($strong - $uex->monoleg_right)*10000)/countingQ($user) ;
                                    }
                                }elseif ($strong > 15000 ){
                                    $bonus = (($strong - $uex->monoleg_right)*20000)/countingQ($user) ;
                                }

                                $flushOut = '';
                                if ($bonus > 2500000) {
                                    if (($strong - $uex->monoleg_left) - userRefaDay($uex->user_id) == 0 ) {
                                        $flushOut = '(Flush Out)';
                                        $bonus = 2500000;
                                    }
                                }

                                // $payment = User::find($uex->user_id);
                                // $payment->balance += $bonus;
                                // $payment->save();

                                // $trx = new Transaction();
                                // $trx->user_id = $payment->id;
                                // $trx->amount = $bonus;
                                // $trx->charge = 0;
                                // $trx->trx_type = '+';
                                // $trx->post_balance = $payment->balance;
                                // $trx->remark = 'monoleg_commission';
                                // $trx->trx = getTrx();
                                // $trx->details = $flushOut.' Paid Monoleg Commission '.($strong - $uex->monoleg_right).' feet : ' . $bonus . ' ' . $gnl->cur_text;
                                // $trx->save();

                                $uex->strong_leg = $strong_text;
                                $uex->monoleg_right = $strong;
                                $uex->save();

                                // monolegSaving($uex->user_id,$bonus,$username->username,'kanan');

                                // $cron[] = $user.'/'.$count.'/'.$strong.'/'.$strong_text.'/third';
                                $cron[] = $user.'/'.$count.'/'.$strong.'/'.$strong_text.'/'.$bonus.'/third';


                            }

                        }
                    }
                

                    // $cron[] = $user.'/'.$count.'/'.$strong.'/'.$strong_text;
                


                // if ($uex->paid_left >= 100 && $uex->paid_right >= 100 && $uex->monoleg_pair != 1) {
                //     # code...
                //     $bonus = ((100*15000)/countingQ($user));

                //     $payment = User::find($uex->user_id);
                //     $payment->balance += $bonus;
                //     $payment->save();

                //     $trx = new Transaction();
                //     $trx->user_id = $payment->id;
                //     $trx->amount = $bonus;
                //     $trx->charge = 0;
                //     $trx->trx_type = '+';
                //     $trx->post_balance = $payment->balance;
                //     $trx->remark = 'monoleg_commission';
                //     $trx->trx = getTrx();
                //     $trx->details = 'Paid Monoleg Commission 100 Feet More On The Left And Right : ' . $bonus . ' ' . $gnl->cur_text;
                //     $trx->save();

                //     $uex->monoleg_pair = 1;
                //     $uex->save();

                //     $cron[] = $user.'/'.$count.'/'.$strong.'/pair';

                // }


            }
        }

        return $cron;
    }

    public function cron()
    {
        
        $gnl = GeneralSetting::first();
        $gnl->last_cron = Carbon::now()->toDateTimeString();
		$gnl->save();
        $userx = UserExtra::where('paid_left','>=',1)
        ->where('paid_right','>=',1)->get();

        // dd($userx);
        $cron = array();
        foreach ($userx as $uex) {
                        $user = $uex->user_id;
                        $weak = $uex->paid_left < $uex->paid_right ? $uex->paid_left : $uex->paid_right;
                        
                        $weaks = $uex->left < $uex->right ? $uex->left : $uex->right;
                      
                        $user_plan = user::where('users.id',$user)
                        ->join('plans','plans.id','=','users.plan_id')
                        ->where('users.plan_id','!=',0)->first(); 
                        
                        $us = user::where('id',$uex->user_id)->first();

                        if(Date('H') == "00"){
                            $uex->limit = 0;
                            $uex->save();
                        }

                        if (!$user_plan) {
                            # code...
                            continue;
                        }
                        if ($weaks >= 20) {
                            # code...
                            // continue;
                            $pairs = intval($weak);
                            $pair = intval($weak);
                        }else{
                            $pairs = intval($weak);
                            $pair = intval($weak);

                        }

                        if ($pair < 1) {
                            # code...
                            continue; 
                        }


                        if ($us->is_leader == 1 && $us->is_manag == 0) {
                            # code...
                            if ($uex->limit > 100 && Carbon::parse($uex->last_getcomm)->format('Y-m-d') == Carbon::now()->toDateString()) {
                                # code...
                                continue; 
                            }
                        }elseif ($us->is_leader == 0 && $us->is_manag == 1) {
                            # code...
                            if ($uex->limit > 300 && Carbon::parse($uex->last_getcomm)->format('Y-m-d') == Carbon::now()->toDateString()) {
                                # code...
                                continue; 
                            }
                        }elseif ($us->is_leader == 0 && $us->is_manag == 0) {
                            if ($uex->limit > 30 && Carbon::parse($uex->last_getcomm)->format('Y-m-d') == Carbon::now()->toDateString()) {
                                # code...
                                continue; 
                            }
                        }else{
                            if ($uex->limit > 30 && Carbon::parse($uex->last_getcomm)->format('Y-m-d') == Carbon::now()->toDateString()) {
                                # code...
                                continue; 
                            }
                        }



                        
                        

                        if($uex->level_binary != 0 && $pairs != $uex->level_binary){
                            // $pair = intval($weak) - $uex->level_binary;
                            if ($pair > $uex->level_binary) {
                                if ($pair - $uex->level_binary >= 20) {
                                    # code...
                                    $pair = 20;
                                    $bonus = intval(($pair) * ($user_plan->tree_com * 2));
                                }else{

                                    if ($pair >= 20) {
                                        $pair = 20;
                                        $bonus = intval(($pair - $uex->level_binary) * ($user_plan->tree_com * 2));
                                    }else{
                                        $bonus = intval(($pair - $uex->level_binary) * ($user_plan->tree_com * 2));
                                    }
                                }

                            }else{
                                if ($pair >= 20) {
                                    $pair = 20;
                                    $bonus = intval(($uex->level_binary - $pair ) * ($user_plan->tree_com * 2));
                                }else{
                                    $bonus = intval(($uex->level_binary - $pair ) * ($user_plan->tree_com * 2));
                                }
                            }
                        }else{
                            if ($pair >= 20) {
                                # code...
                                $pair = 20;
                                $bonus = intval($pair * ($user_plan->tree_com * 2));
                            }else{
                                $bonus = intval($pair * ($user_plan->tree_com * 2));
                            }
                        }

                        $pair2[] = $pair == $uex->level_binary;

                        if ($pair >= 20) {
                            $pair = 20;
                        }

                        // if($uex->level_binary != 0 && $pairs != $uex->level_binary){
                        //     // $pair = intval($weak) - $uex->level_binary;
                        //     if ($pair > $uex->level_binary) {
                        //         $bonus = intval(($pair - $uex->level_binary) * ($user_plan->tree_com * 2));
                        //     }else{
                        //         $bonus = intval(($uex->level_binary - $pair ) * ($user_plan->tree_com * 2));
                        //     }
                        // }else{
                        //     $bonus = intval($pair * ($user_plan->tree_com * 2));
                        // }
                        // $bonus = intval($pair * ($user_plan->tree_com * 2));

                        // dd(is_numeric($uex->paid_left));


                        if ($pair == $uex->level_binary) {
                            // if ($uex->level_binary == 20) {
                            //     $payment = User::find($uex->user_id);
                            //     $payment->balance += $bonus;
                            //     $payment->save();
    
                            //     $trx = new Transaction();
                            //     $trx->user_id = $payment->id;
                            //     $trx->amount = $bonus;
                            //     $trx->charge = 0;
                            //     $trx->trx_type = '+';
                            //     $trx->post_balance = $payment->balance;
                            //     $trx->remark = 'binary_commission';
                            //     $trx->trx = getTrx();
                            //     $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';
                            //     $trx->save();

                            //     $uex->paid_left = 0;
                            //     $uex->paid_right = 0;
                            //     $uex->save();
    
                            //     sendEmail2($user, 'matching_bonus', [
                            //             'amount' => $bonus,
                            //             'currency' => $gnl->cur_text,
                            //             'paid_bv' => $pair * 2,
                            //             'post_balance' => $payment->balance,
                            //             'trx' =>  $trx->trx,
                            //     ]);
                            // }else{

                            // }

                        }else{
                            $payment = User::find($uex->user_id);
                            $payment->balance += $bonus;
                            $payment->total_binary_com += $bonus;
                            

                            $trx = new Transaction();
                            $trx->user_id = $payment->id;
                            $trx->amount = $bonus;
                            $trx->charge = 0;
                            $trx->trx_type = '+';
                            $trx->post_balance = $payment->balance;
                            $trx->remark = 'binary_commission';
                            $trx->trx = getTrx();

                            if ($pair >= 20) {
                                
                                    if ($uex->last_flush_out) {
                                        if (Carbon::parse($uex->last_flush_out)->format('Y-m-d') != Carbon::now()->toDateString()) {
                                        # code...

                                            $paid_bv = $uex->paid_left + $uex->paid_right;
                                        // }else{
                                        // }
                                        
                                            // sendEmail2($user, 'matching_bonus', [
                                            //         'amount' => $bonus,
                                            //         'currency' => $gnl->cur_text,
                                            //         'paid_bv' => $paid_bv,
                                            //         'post_balance' => $payment->balance,
                                            //         'trx' =>  $trx->trx,
                                            // ]);
                                        
                                            if($uex->level_binary == 0){
                                                if (Carbon::parse($uex->updated_at)->format('Y-m-d') != Carbon::now()->toDateString()) {
                                                    $payment->save();
                                                    $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' Pairs.';
                                                // }else{
                                                //     $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 6 . ' MP.';
                                                // }

                                            // }
                                                    $trx->save();
                                                    
                                                    $uex->paid_left -= $weak;
                                                    $uex->paid_right -= $weak;
                                                    // $uex->paid_left -= 20;
                                                    // $uex->paid_right -= 20;
                                                    $uex->level_binary = 0;
                                                    
                                                    // $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                    $uex->limit += $pair;
                                                    $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                                    $uex->save();

                                                    $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                    $gnl->save();

                                                    // Carbon::now()->toDateString()
                                                    $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d').'/FlushOut2';
                                                }else{
                                                
                                                        $payment->save();
                                                        $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' Pairs.';
    
                                                        $trx->save();
                                                    
                                                        $uex->paid_left -= 20;
                                                        $uex->paid_right -= 20;
                                                        $uex->level_binary = 0;
                                                        // $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                        $uex->limit += ($pair-$uex->level_binary);
                                                        $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                                        $uex->save();
            
                                                        $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                        $gnl->save();
            
                                                        // Carbon::now()->toDateString()
                                                        $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d');
                                                }
                                                
                                            }else{

                                                
                                                    $payment->save();
                                                    $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';

                                                    $trx->save();
                                                
                                                    $uex->paid_left -= 20;
                                                    $uex->paid_right -= 20;
                                                    $uex->level_binary = 0;
                                                    // $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                    $uex->limit += ($pair-$uex->level_binary);
                                                    $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                                    $uex->save();
        
                                                    $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                    $gnl->save();
        
                                                    // Carbon::now()->toDateString()
                                                    $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d');
                                                
                                            }
                                        }else{

                                        
                                        # code...

                                                $paid_bv = $uex->paid_left + $uex->paid_right;
                                                // }else{
                                                // }
                                                
                                                    // sendEmail2($user, 'matching_bonus', [
                                                    //         'amount' => $bonus,
                                                    //         'currency' => $gnl->cur_text,
                                                    //         'paid_bv' => $paid_bv,
                                                    //         'post_balance' => $payment->balance,
                                                    //         'trx' =>  $trx->trx,
                                                    // ]);
                                                
                                                // if ($pair >= 20) {
                                                $payment->save();

                                                if($uex->level_binary == 0){
                                                    $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';
                                                }else{
                                                    $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';
                                                }
                                                $trx->save();
                                                
                                                $uex->paid_left -= 20;
                                                $uex->paid_right -= 20;
                                                $uex->level_binary = 0;
                                                $uex->limit += ($pair-$uex->level_binary);
                                                $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                                // $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                $uex->save();

                                                $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                $gnl->save();

                                                // Carbon::now()->toDateString()
                                                $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d');
                                            
                                        }
                                    }else{

                                        
                                        # code...

                                            $paid_bv = $uex->paid_left + $uex->paid_right;
                                            // }else{
                                            // }
                                            
                                                // sendEmail2($user, 'matching_bonus', [
                                                //         'amount' => $bonus,
                                                //         'currency' => $gnl->cur_text,
                                                //         'paid_bv' => $paid_bv,
                                                //         'post_balance' => $payment->balance,
                                                //         'trx' =>  $trx->trx,
                                                // ]);
                                            
                                            // if ($pair >= 20) {
                                            

                                                if($uex->level_binary == 0){
                                                    if (Carbon::parse($uex->updated_at)->format('Y-m-d') != Carbon::now()->toDateString()) {
                                                        $payment->save();
                                                        // $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 6 . ' MP.';
                                                        $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';
                                                    // }else{
                                                    //     $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 6 . ' MP.';
                                                    // }

                                                // }
                                                        $trx->save();
                                                        
                                                        // $uex->paid_left -= 20;
                                                        // $uex->paid_right -= 20;
                                                        $uex->paid_left -= $weak;
                                                        $uex->paid_right -= $weak;
                                                        $uex->level_binary = 0;
                                                        $uex->limit += $pair;
                                                        $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                        $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                                        $uex->save();

                                                        $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                        $gnl->save();

                                                        // Carbon::now()->toDateString()
                                                        $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d').'/FlushOut1';
                                                    }else{
                                                            $payment->save();
                                                            $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';
    
                                                            $trx->save();
                                                        
                                                            $uex->paid_left -= 20;
                                                            $uex->paid_right -= 20;
                                                            $uex->level_binary = 0;
                                                            $uex->limit += ($pair-$uex->level_binary);
                                                            // $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                            $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                                            $uex->save();
                
                                                            $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                            $gnl->save();
                
                                                            // Carbon::now()->toDateString()
                                                            $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d');
                                                    }
                                                    
                                                }else{
                                                        $payment->save();
                                                        $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';

                                                        $trx->save();
                                                    
                                                        $uex->paid_left -= 20;
                                                        $uex->paid_right -= 20;
                                                        $uex->level_binary = 0;
                                                        $uex->limit += ($pair-$uex->level_binary);
                                                        $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                                        // $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                        $uex->save();
            
                                                        $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                        $gnl->save();
            
                                                        // Carbon::now()->toDateString()
                                                        $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d');
                                                }
                                                
                                    }
                                



                            }else{
                                    # code...
                                
                                $paid_bv = $pair * 2;
                                // sendEmail2($user, 'matching_bonus', [
                                //     'amount' => $bonus,
                                //     'currency' => $gnl->cur_text,
                                //     'paid_bv' => $paid_bv,
                                //     'post_balance' => $payment->balance,
                                //     'trx' =>  $trx->trx,
                                // ]);
                                $payment->save();

                                    if($uex->level_binary != 0 && $pairs != $uex->level_binary){
                                        $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';
                                        $uex->limit += ($pair-$uex->level_binary);
                                        $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                    }else{
                                        $uex->limit += $pair;
                                        $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                        $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';

                                    }
                                $trx->save();

                                $uex->level_binary = $pair;
                                $uex->save();

                                $gnl->last_paid = Carbon::now()->toDateTimeString();
                                $gnl->save();

                                $cron[] = $user.'/'.$pair;
                            }

                            
                        }
        }
        return $cron;
        // dd($dd);

    }
    // public function cron20MP()
    // {
    //     $gnl = GeneralSetting::first();
    //     $gnl->last_cron = Carbon::now()->toDateTimeString();
	// 	$gnl->save();

    //     $userx = UserExtra::whereBetween('paid_left','>=',30)
    //     ->whereBetween('paid_right','>=',30)->get();
    //     foreach ($userx as $uex) {
    //                     $user = $uex->user_id;
    //                     $weak = $uex->paid_left < $uex->paid_right ? $uex->paid_left : $uex->paid_right;
    //                     // $weaker = $weak < $gnl->max_bv ? $weak : $gnl->max_bv;
    //                     $user_plan = user::where('users.id',$user)
    //                     ->join('plans','plans.id','=','users.plan_id')->first();
    //                     $pair = intval($weak);
    //                     $bonus = intval($pair * ($user_plan->tree_com * 2));

    //                         $payment = User::find($uex->user_id);
    //                         $payment->balance += $bonus;
    //                         $payment->save();

    //                         $trx = new Transaction();
    //                         $trx->user_id = $payment->id;
    //                         $trx->amount = $bonus;
    //                         $trx->charge = 0;
    //                         $trx->trx_type = '+';
    //                         $trx->post_balance = $payment->balance;
    //                         $trx->remark = 'binary_commission';
    //                         $trx->trx = getTrx();
    //                         $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';
    //                         $trx->save();

    //                         $uex->level_binary = $pair;
    //                         $uex->save();

    //                         sendEmail2($user, 'matching_bonus', [
    //                                 'amount' => $bonus,
    //                                 'currency' => $gnl->cur_text,
    //                                 'paid_bv' => $pair * 2,
    //                                 'post_balance' => $payment->balance,
    //                                 'trx' =>  $trx->trx,
    //                             ]);
    //     }
    //     // dd($dd);
    // }

    public function oldGold(){
        $user = UserExtra::where('is_gold',0)->get();
        foreach ($user as $key => $value) {
            $ex = UserExtra::find($value->id);
            if($ex->left >= 3 && $ex->right >= 3){
                $ex->update([
                    'is_gold' => 1
                ]);
            }
        }
    }
    public function isGold(){
        $users = User::join('user_extras','users.id','=','user_extras.user_id')
            ->where('is_gold',0)
            ->where('bonus_deliver', 0)
            ->orWhereNull('bonus_deliver')
            ->get();
        // dd($users);
        $record = 0;
        $true = 0;
        $false = 0;
        foreach ($users as $key => $value) {
            $userID = $value->user_id;
            $user = User::where('ref_id',$userID)->get();
            $count = $user->count();
            if ($count >= 6) {
                $kiri = 0;
                $kanan = 0;
                $p_kiri =0;
                $p_kanan =0;
                // dd($user);
                foreach ($user as $key => $value) {
                    if($value->position==1){
                        $kiri += 1;
                    }
                    if ($value->position==2) {
                        $kanan += 1;
                    }
                    if($value->position_by_ref==1){
                        $p_kiri += 1;
                    }
                    if($value->position_by_ref==2){
                        $p_kanan += 1;
                    }
                    
                }
                $userex = UserExtra::where('user_id',$userID)->first();
                if($userex){
                    if($kiri == 3 && $kanan == 3){
                        $userex->update([
                            'is_gold'   => 1,
                            'right_lv'  => $kanan,
                            'left_lv'   => $kiri,
                            'on_gold'   => date('Y-m-d H:i:s')
                        ]);
                        $true += 1;
                    }elseif($kiri > 3 && $kanan > 3){
                        $userex->update([
                            'is_gold'           => 1,
                            'bonus_deliver'     => 1,
                            'right_lv'          => $kanan,
                            'left_lv'           => $kiri
                        ]);
                        $true += 1;
                    }


                    if($p_kiri == 3 && $p_kanan == 3){
                        $userex->update([
                            'is_gold'   => 1,
                            'right_lv'  => $kanan,
                            'left_lv'   => $kiri,
                            'on_gold'   => date('Y-m-d H:i:s')
                        ]);
                        $true += 1;
                    }else
                    if($p_kiri > 3 && $p_kanan > 3){
                        $userex->update([
                            'is_gold'           => 1,
                            'bonus_deliver'     => 1,
                            'right_lv'          => $kanan,
                            'left_lv'           => $kiri
                        ]);
                        $true += 1;
                    }
                    else{
                        $userex->update([
                            'right_lv'  => $kanan,
                            'left_lv'   => $kiri
                        ]);
                    }
                }
            }
            
            $record += 1;
        }
        return [
            'status'=>'success',
            'record'=> $record,
            'gold'  => $true,
        ];
    }

    public function isGoldBack(){
        $users = User::join('user_extras','users.id','=','user_extras.user_id')->where('is_gold',1)->where('username','not like','%masterplan%')->get();
        $userData = [];

        foreach ($users as $key => $value) {
            $userID = $value->user_id;
            $userRef = User::where('ref_id',$userID)->get();
            $count = $userRef->count();
            // dd($userRef);
            if($count < 6){
                $userData[] = [ 
                    'user' => [
                        'id' => $userID,
                        'username' => $value->username,
                        'count'     => $count
                    ],
                ];
                $extra = UserExtra::where('user_id',$userID)->update(['is_gold'=>0,'bonus_deliver'=>0]);
            }
        }
        return [
            'status'=>'success',
            'user'  => $userData,
        ];
    }
    public function sendWa($msg){
        $apiEndpoint = 'https://wa.srv5.wapanels.com/send-message';
        $postData = [
            'api_key' => env('WA_API_KEY'), // isi api key di menu profile -> setting
            'sender' => env('WA_SENDER'), // isi no device yang telah di scan
            'number' => env('WA_NUMBER'), // isi no pengirim
            'message' => $msg // isi pesan
        ];
        $response = Http::post($apiEndpoint, $postData);
        $res = json_decode($response->body(),true);
        dd($res);
    }
    public function sendMessege($msg){
        $data = [
            'api_key' => env('WA_API_KEY'), // isi api key di menu profile -> setting
            'sender' => env('WA_SENDER'), // isi no device yang telah di scan
            'number' => env('WA_NUMBER'), // isi no pengirim
            'message' => $msg // isi pesan
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://wa.srv5.wapanels.com/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json($response); 
    }

    public function isSilverCheck(){

        $users = User::join('user_extras','users.id','=','user_extras.user_id')->where('is_gold',0)->get();
        $userData = [];
        // dd($silver);
        foreach ($users as $key => $value) {
            $userID = $value->user_id;
            $userRef = User::where('ref_id',$userID)->get();
            $count = $userRef->count();
            // dd($userRef);
            if($count >= 6){
                // check in database.
                $silver = SilverCheck::where('user_id',$userID)->first();
                if(!$silver){
                    $msg = "New is-gold need to check: " . PHP_EOL . "id : $userID" . PHP_EOL . "username : $value->username" . PHP_EOL . "count : $count";
                    $send = sendWa($msg);
                    if($send['status']){
                        SilverCheck::create([
                            'user_id' => $userID,
                            'username' => $value->username,
                            'count'     => $count
                        ]);
                    }
                }
                $userData[] = [ 
                    'user' => [
                        'id' => $userID,
                        'username' => $value->username,
                        'count'     => $count
                    ],
                ];
                
            }
        }
        return [
            'status'=>'success',
            'user'  => $userData,
        ];
    }
    public function isSilverCron(){
        $users = User::join('user_extras','users.id','=','user_extras.user_id')->where('is_gold',0)->get();
        $userData = [];
        // dd($silver);
        foreach ($users as $key => $value) {
            $userID = $value->user_id;
            $userRef = User::where('ref_id',$userID)->get();
            $count = $userRef->count();
            // dd($userRef);
            if($count >= 6){
                // check in database.
                $silver = SilverCheck::where('user_id',$userID)->first();
                if(!$silver){
                    // simpan ke db
                    SilverCheck::create([
                        'user_id' => $userID,
                        'username' => $value->username,
                        'count'     => $count
                    ]);
                    //send message
                    $msg = "New is-gold need to check: " . PHP_EOL . "id : $userID" . PHP_EOL . "username : $value->username" . PHP_EOL . "count : $count";
                    $this->sendMessege($msg);
                }
            }
        }
        return ['sts'=>200,'msg'=>'ok'];
    }

     public function dailyGold(){
        $url = 'https://www.hargaemas.com/';
        $page =  GoutteFacade::request('GET',$url);
        // echo "<pre>";
        // print_r($page);
        $harga = $page->filter('.price-current')->text();
        $hragaInt = str_replace('.', '', $harga);
        // dd(Int$harga);
        $last = DailyGold::orderByDesc('id')->first();
        $percent = (($hragaInt - $last->per_gram) / $last->per_gram) * 100;
        $percent_num = number_format($percent, 2, '.', '');
        $dd = DailyGold::create([
            'per_gram'  => $hragaInt,
            'percent'   => $percent_num,
            'date'      => Date('Y-m-d')
        ]);

        return $dd;
    }
    public function userAddressLang(){
        $user = User::whereNull('lat')->get();
        $s = 1;
        $e = 1;
        foreach ($user as $key => $value) {
            // $alamat = json_decode($value->address,true);
            $city = $value->address->city;
            $client = new Client();
            if ($city != null || $city != "") {
                $url = "http://www.gps-coordinates.net/api/".$city;
            
                $response = $client->request('GET',$url,['verify' => false]);
                $res_body = json_decode($response->getBody(),true);
                if ($res_body['responseCode'] == 200) {
                    User::find($value->id)->update([
                        'lat'=>$res_body['latitude'],
                        'lng'=>$res_body['longitude'],
                    ]);
                    $s++;
                }else{
                    $e++;
                    break;
                }
              } 
        }
        return 'Success ' .$s.' update, '.$e. 'error';
    }
    public function gems(){
        $today = date('Y-m-d');
        // $today = '2023-09-01';
        $rekenings = DB::table('users as u')
            // ->select('u.id', 'u.username', 'r.nama_bank', 'r.nama_akun')
            ->select('u.id', 'u.username', 'r.nama_bank', 'r.nama_akun', DB::raw('COUNT(*) AS count_user'))
            ->join('rekenings as r', 'u.id', '=', 'r.user_id')
            ->whereDate('u.created_at', $today)
            ->groupBy('r.nama_bank', 'r.nama_akun')
            ->get();
            $no = 1;
            foreach ($rekenings as $key => $value) {
                if($value->count_user >=7){
                    $deliver = DB::table('users as u')
                        ->select('u.id', 'u.username', 'r.nama_bank', 'r.nama_akun')
                        ->join('rekenings as r', 'u.id', '=', 'r.user_id')
                        ->whereDate('u.created_at', $today)
                        ->where('nama_bank',$value->nama_bank)
                        ->where('nama_akun',$value->nama_akun)
                        ->get(7);
                    foreach ($deliver as $keyi => $v) {
                        $user = User::find($v->id);
                        $user->update([
                            'gems'  => 1,
                            'gems_flag' => 1,
                        ]);
                    }
                }
                if($value->count_user < 7){
                    $user1 = User::find($value->id);
                    $user1->update([
                        'gems_dlv'  => 1,
                        'gems_flag' => 1,
                    ]);
                }
                $no+1;
            }
        $msg = "Cron Deliver Gems Daily Running " . PHP_EOL . "date : $today" . PHP_EOL  . "count : $no";
        $wa = $this->sendMessege($msg);
        return $wa;

    }

    public function new_ps(){
        $users = User::where('new_ps', 1)->orderByDesc('id')->get();
    
        foreach ($users as $user) {
            $currentDate = now(); // Carbon::now() is not necessary here
            
            $created = $user->created_at;
            $differenceInDays = $created->diffInDays($currentDate);
            
            if ($differenceInDays >= 30) {
                dd('lewat');
            }
            
            dd($created); // If you want to get the date 30 days from the creation date
        }
    }

}
