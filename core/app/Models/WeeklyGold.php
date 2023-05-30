<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyGold extends Model
{
    use HasFactory;
    protected $table ='weekly_gold';
    protected $guarded = ['id'];
}
