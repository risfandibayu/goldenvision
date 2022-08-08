<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronController extends Controller
{
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
    public function cron()
    {
        $gnl = GeneralSetting::first();
        $gnl->last_cron = Carbon::now()->toDateTimeString();
		$gnl->save();

        $userx = UserExtra::where('paid_left','>=',3)
        ->where('paid_right','>=',3)->get();
        foreach ($userx as $uex) {
                        $user = $uex->user_id;
                        $weak = $uex->paid_left < $uex->paid_right ? $uex->paid_left : $uex->paid_right;
                        // $weaker = $weak < $gnl->max_bv ? $weak : $gnl->max_bv;
                        $user_plan = user::where('users.id',$user)
                        ->join('plans','plans.id','=','users.plan_id')->first();                        
                        $pair = intval($weak / 3);
                        $bonus = intval($pair * ($user_plan->tree_com * 6));

                        if ($pair == $uex->level_binary) {
                            if ($uex->level_binary == 10) {
                                $payment = User::find($uex->user_id);
                                $payment->balance += $bonus;
                                $payment->save();
    
                                $trx = new Transaction();
                                $trx->user_id = $payment->id;
                                $trx->amount = $bonus;
                                $trx->charge = 0;
                                $trx->trx_type = '+';
                                $trx->post_balance = $payment->balance;
                                $trx->remark = 'binary_commission';
                                $trx->trx = getTrx();
                                $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 6 . ' BRO.';
                                $trx->save();
                                
                                $uex->paid_left = 30;
                                $uex->paid_right = 30;
                                $uex->save();
    
                                sendEmail2($user, 'matching_bonus', [
                                        'amount' => $bonus,
                                        'currency' => $gnl->cur_text,
                                        'paid_bv' => $pair * 6,
                                        'post_balance' => $payment->balance,
                                        'trx' =>  $trx->trx,
                                ]);
                            }else{

                            }

                        }else{
                            $payment = User::find($uex->user_id);
                            $payment->balance += $bonus;
                            $payment->save();

                            $trx = new Transaction();
                            $trx->user_id = $payment->id;
                            $trx->amount = $bonus;
                            $trx->charge = 0;
                            $trx->trx_type = '+';
                            $trx->post_balance = $payment->balance;
                            $trx->remark = 'binary_commission';
                            $trx->trx = getTrx();
                            $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 6 . ' BRO.';
                            $trx->save();

                            $uex->level_binary = $pair;
                            $uex->save();

                            sendEmail2($user, 'matching_bonus', [
                                    'amount' => $bonus,
                                    'currency' => $gnl->cur_text,
                                    'paid_bv' => $pair * 6,
                                    'post_balance' => $payment->balance,
                                    'trx' =>  $trx->trx,
                                ]);
                        }
        }
        // dd($dd);
    }
    // public function cron30bro()
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
    //                     $pair = intval($weak / 3);
    //                     $bonus = intval($pair * ($user_plan->tree_com * 6));

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
    //                         $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 6 . ' BRO.';
    //                         $trx->save();

    //                         $uex->level_binary = $pair;
    //                         $uex->save();

    //                         sendEmail2($user, 'matching_bonus', [
    //                                 'amount' => $bonus,
    //                                 'currency' => $gnl->cur_text,
    //                                 'paid_bv' => $pair * 6,
    //                                 'post_balance' => $payment->balance,
    //                                 'trx' =>  $trx->trx,
    //                             ]);
    //     }
    //     // dd($dd);
    // }
}
