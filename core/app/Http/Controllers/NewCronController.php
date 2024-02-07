<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewCronController extends Controller
{
    public function bonusPasangan()
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
                      
                        $user_plan = User::where('users.id',$user)
                        ->join('plans','plans.id','=','users.plan_id')
                        ->where('users.plan_id','!=',0)->first(); 
                        
                        $us = User::where('id',$uex->user_id)->first();

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
                            if ($uex->limit > 20 && Carbon::parse($uex->last_getcomm)->format('Y-m-d') == Carbon::now()->toDateString()) {
                                # code...
                                continue; 
                            }
                        }else{
                            if ($uex->limit > 20 && Carbon::parse($uex->last_getcomm)->format('Y-m-d') == Carbon::now()->toDateString()) {
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
                                            $trx->details = '[1] Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair. ' Pairs.';
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
                                                $trx->details = '[2] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) . ' Pairs.';

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
                                            $trx->details = '[3] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) . ' Pairs.';

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
                                            $trx->details = '[4] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair . ' Pairs.';
                                        }else{
                                            $trx->details = '[5] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) . ' Pairs.';
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
                                                        $trx->details = '[6] Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair . ' Pairs.';
                                                   
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
                                                            $trx->details = '[6.5] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) . ' Pairs.';
    
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
                                                        $trx->details = '[7] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) . ' Pairs.';

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
                                        $trx->details = '[8] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) . ' Pairs.';
                                        $uex->limit += ($pair-$uex->level_binary);
                                        $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                    }else{
                                        $uex->limit += $pair;
                                        $uex->last_getcomm = Carbon::now()->toDateTimeString();
                                        $trx->details = '[9] Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair . ' Pairs.';

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

    public function checkSponsor(){
        $sponsor = User::where('comp',0)->get();
        foreach ($sponsor as $key => $value) {
          
            $update = checkQuali($value->id);
        }
        return 'success';
    //    $id = [54,63,70,73,76,627,629,631,99,527];
    //    $uex = UserExtra::whereIn('user_id',$id)->get();
    //    foreach ($uex as $key => $value) {
    //         $value->is_gold = 0;
    //         $value->save();
    //    }      
    //    return true;
    //    $isGoldUser = User::join 
       $referralCounts = User::groupBy('ref_id')
            ->selectRaw('ref_id, count(*) as count')
            ->where('ref_id','!=',0)
            ->get();
        $updated = [];   
        foreach ($referralCounts as $ex) {
            $ex = UserExtra::where('is_gold',0)->where('user_id',$ex->ref_id)->first();
            if($ex){
                $ex->update(['is_gold'=>1]);
                $updated[] = 'update qualified user: '. $ex->id;
            }
            
        }
        if($updated !== null){
            addToLog(json_encode($updated));
        }
        return $updated;
        
    }
}
