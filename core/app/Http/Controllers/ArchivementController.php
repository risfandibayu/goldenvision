<?php

namespace App\Http\Controllers;

use App\Models\DailyGold;
use App\Models\Transaction;
use App\Models\ureward;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArchivementController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    public function index(){
        $data['page_title'] = "Archivement";
        $data['user']       = auth()->user();
        $data['title']          = title();
        $data['bonus']      = ureward::with(['user'])->where('user_id',auth()->user()->id)->get();
        return view($this->activeTemplate . 'user.archivement', $data);
    }
    public function tarikEmas(){
        $data['page_title'] = "Tarik Emas";
        $data['user']       = auth()->user();
        $data['title']          = title();
        $data['bonus']      = ureward::with(['user'])->where('user_id',auth()->user()->id)->get();
        return view($this->activeTemplate . 'user.archivement', $data);
    }
    public function tarikEmasPost(Request $request){
        $user = Auth::user();
        $gold = DailyGold::orderByDesc('id')->first();  
        $goldToday = $gold->per_gram - ($gold->per_gram*8/100); //gold per gram today - 8%
        // dd($goldRange);
        $gram = emas25()['gold'];
        $total = round($goldToday * $gram);
        $platformFee = 0.05 * $total;
        $totalFee =round($total-$platformFee);
        DB::beginTransaction();
        try {
            $id = emas25()['userId'];
            $user2 = User::whereIn('id',$id)->get();
            foreach ($user2 as $value) {
               $value->emas = 0;
               $value->save();
            }

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $totalFee;
            $transaction->post_balance = $user->balance + $totalFee;
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->details = 'Tarik Emas '.$gram.' grams to IDR '.nb($totalFee);
            $transaction->remark = 'tarik_emas';
            $transaction->trx =  getTrx();
            $transaction->save();

            $user->balance += $totalFee;
            $user->save();
// dd($user);
            DB::commit();
            addToLog('Tarik Emas '.$gram.' grams to IDR '.nb($totalFee));

            $notify[] = ['success', 'Tarik Emas '.$gram.' grams to IDR '.nb($totalFee).' Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Throwable $th) {
            addToLog('Error Tarik Emas '.$th->getMessage());
            DB::rollBack();
            $notify[] = ['error', 'Error Tarik Emas '.$th->getMessage()];
            return redirect()->back()->withNotify($notify);

        }
    }

}
