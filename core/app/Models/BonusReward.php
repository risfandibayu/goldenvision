<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PDO;

class BonusReward extends Model
{
    protected $table = 'bonus_rewards';
    protected $guarded = [];
    public function ureward(){
        return $this->hasMany(ureward::class);
    }
}
