<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class LogActivity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'log_activities';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
