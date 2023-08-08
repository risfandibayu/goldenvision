<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusUser extends Model
{
    use HasFactory;
    protected $table = 'bonus_user';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function bonus(){
        return $this->belongsTo(BonusReward::class,'bonus_id');
    }
}
