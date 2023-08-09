<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SilverCheck extends Model
{
    use HasFactory;
    protected $table='silver_checks';
    protected $guarded = ['id'];
    public $timestamps = false;

}
