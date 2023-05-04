<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserExtra extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public static function userGold()
    {
        $dg = DailyGold::orderByDesc('id')->first();
        $ue = UserExtra::with('user')->where('is_gold',1)->get();
        $data = [];
        foreach ($ue as $key => $value) {
            $ug = UserGold::where('user_id',$value->user_id)->select(DB::raw('SUM(golds) AS gold'))
                    ->groupBy('user_id')
                    ->first();
                    if($ug){
                        $gold = $ug->gold;
                    }else{
                        $gold = 0;
                    }
            $data[] = [
                'no' => $key +1,
                'username' => $value->user->username,
                'gold'  => $gold,
                'harga' => $gold * $dg->per_gram, 
            ];
        }
        return $data;
    }
}
