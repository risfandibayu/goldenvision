<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyGold extends Model
{
    use HasFactory;
    protected $table = 'daily_gold';
    protected $guarded = ['id'];
}
