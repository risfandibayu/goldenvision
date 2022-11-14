<?php

namespace App\Models;

use App\Enums\UserGoldReward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGold extends Model
{
    use HasFactory;

    protected $table = 'user_golds';

    protected $fillable = [
        'golds', 'type', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDailyGoldsOf($builder, $id)
    {
        return $builder->where('user_id', $id)->where('type', UserGoldReward::Daily->value);
    }


    public function scopeWeeklyGoldsOf($builder, $id)
    {
        return $builder->where('user_id', $id)->where('type', UserGoldReward::Weekly->value);
    }
}
