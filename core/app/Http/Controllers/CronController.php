<?php

namespace App\Http\Controllers;

use App\Models\DailyGold;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Weidner\Goutte\GoutteFacade;

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
        // dd(Date('H:i') == "14:57");
        $userx = UserExtra::where('paid_left','>=',3)
        ->where('paid_right','>=',3)->get();

        // dd($userx);
        $cron = array();
        foreach ($userx as $uex) {
                        $user = $uex->user_id;
                        $weak = $uex->paid_left < $uex->paid_right ? $uex->paid_left : $uex->paid_right;
                        $weaks = $uex->left < $uex->right ? $uex->left : $uex->right;
                        // $weaker = $weak < $gnl->max_bv ? $weak : $gnl->max_bv;
                        $user_plan = user::where('users.id',$user)
                        ->join('plans','plans.id','=','users.plan_id')
                        ->where('users.plan_id','!=',0)->first(); 
                        
                        if (!$user_plan) {
                            # code...
                            continue;
                        }
                        if ($weaks >= 30 || $uex->bonus_deliver == 1) {
                            # code...
                            // continue;
                            $pairs = intval($weak);
                            $pair = intval($weak);
                        }else{
                            $pairs = intval($weak)-3;
                            $pair = intval($weak)-3;

                        }

                        if ($pair < 1) {
                            # code...
                            continue; 
                        }
                        

                        if($uex->level_binary != 0 && $pairs != $uex->level_binary){
                            // $pair = intval($weak) - $uex->level_binary;
                            if ($pair > $uex->level_binary) {
                                if ($pair - $uex->level_binary >= 30) {
                                    # code...
                                    $pair = 30;
                                    $bonus = intval(($pair) * ($user_plan->tree_com * 2));
                                }else{

                                    if ($pair >= 30) {
                                        $pair = 30;
                                        $bonus = intval(($pair - $uex->level_binary) * ($user_plan->tree_com * 2));
                                    }else{
                                        $bonus = intval(($pair - $uex->level_binary) * ($user_plan->tree_com * 2));
                                    }
                                }

                            }else{
                                if ($pair >= 30) {
                                    $pair = 30;
                                    $bonus = intval(($uex->level_binary - $pair ) * ($user_plan->tree_com * 2));
                                }else{
                                    $bonus = intval(($uex->level_binary - $pair ) * ($user_plan->tree_com * 2));
                                }
                            }
                        }else{
                            if ($pair >= 30) {
                                # code...
                                $pair = 30;
                                $bonus = intval($pair * ($user_plan->tree_com * 2));
                            }else{
                                $bonus = intval($pair * ($user_plan->tree_com * 2));
                            }
                        }

                        $pair2[] = $pair == $uex->level_binary;

                        if ($pair >= 30) {
                            $pair = 30;
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
                            // if ($uex->level_binary == 30) {
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
                            //     $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' BRO.';
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

                            if ($pair >= 30) {
                                
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
                                                $payment->save();
                                                $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';
                                            // }else{
                                            //     $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';
                                            // }

                                        // }
                                                $trx->save();
                                                
                                                $uex->paid_left = 0;
                                                $uex->paid_right = 0;
                                                $uex->level_binary = 0;
                                                $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                $uex->save();

                                                $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                $gnl->save();

                                                // Carbon::now()->toDateString()
                                                $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d').'/FlushOut2';
                                                
                                            }else{

                                                
                                                    $payment->save();
                                                    $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';

                                                    $trx->save();
                                                
                                                    $uex->paid_left -= 30;
                                                    $uex->paid_right -= 30;
                                                    $uex->level_binary = 0;
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
                                                
                                                // if ($pair >= 30) {
                                                $payment->save();

                                                if($uex->level_binary == 0){
                                                    $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';
                                                }else{
                                                    $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';
                                                }
                                                $trx->save();
                                                
                                                $uex->paid_left -= 30;
                                                $uex->paid_right -= 30;
                                                $uex->level_binary = 0;
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
                                            
                                            // if ($pair >= 30) {
                                            

                                                if($uex->level_binary == 0){
                                                    $payment->save();
                                                    $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * 2 . ' MP.';
                                                // }else{
                                                //     $trx->details = 'Paid Flush Out ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';
                                                // }

                                            // }
                                                    $trx->save();
                                                    
                                                    $uex->paid_left -= 30;
                                                    $uex->paid_right -= 30;
                                                    $uex->level_binary = 0;
                                                    $uex->last_flush_out = Carbon::now()->toDateTimeString();
                                                    $uex->save();

                                                    $gnl->last_paid = Carbon::now()->toDateTimeString();
                                                    $gnl->save();

                                                    // Carbon::now()->toDateString()
                                                    $cron[] = $user.'/'.$pair.'/'.Carbon::parse($uex->last_flush_out)->format('Y-m-d').'/FlushOut1';
                                                    
                                                }else{
                                                        $payment->save();
                                                        $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . ($pair-$uex->level_binary) * 2 . ' MP.';

                                                        $trx->save();
                                                    
                                                        $uex->paid_left -= 30;
                                                        $uex->paid_right -= 30;
                                                        $uex->level_binary = 0;
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
                                    }else{
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
        $users = User::join('user_extras','users.id','=','user_extras.user_id')->where('is_gold',0)->get();
        $record = 0;
        $true = 0;
        $false = 0;
        foreach ($users as $key => $value) {
            $userID = $value->id;
            $user = User::where('ref_id',$userID)->get();
            $kiri = 0;
            $kanan = 0;
            foreach ($user as $key => $value) {
                if($value->position==1){
                    $kiri += 1;
                }elseif ($value->position==2) {
                    $kanan += 1;
                }
                
            }
            $userex = UserExtra::where('user_id',$userID)->first();
            if($kiri == 3 && $kanan == 3){
                $userex->update([
                    'is_gold'   => 1,
                    'right_lv'  => $kanan,
                    'left_lv'   => $kiri
                ]);
                $true += 1;
            }else if($kiri > 3 && $kanan > 3){
                $userex->update([
                    'bonus_deliver'     => 1,
                    'right_lv'          => $kanan,
                    'left_lv'           => $kiri
                ]);
                $true += 1;
            }else{
                $userex->update([
                    'right_lv'  => $kanan,
                    'left_lv'   => $kiri
                ]);
            }
            $record += 1;
        }
        return [
            'status'=>'success',
            'record'=> $record,
            'gold'  => $true,
        ];
    }

     public function dailyGold(){
        $url = 'https://www.hargaemas.com/';
        $page =  GoutteFacade::request('GET',$url);
        // echo "<pre>";
        // print_r($page);
        $harga = $page->filter('.price-current')->text();
        $hragaInt = str_replace('.', '', $harga);
        // dd(Int$harga);
        $dd = DailyGold::create([
            'per_gram'  => $hragaInt,
            'date'      => Date('Y-m-d')
        ]);

        return $dd;
    }

}
