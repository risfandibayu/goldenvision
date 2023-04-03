<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ureward extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function rewa()
    {
        return $this->belongsTo(BonusReward::class, 'reward_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status(){
        if($this->status == 1){
            return '<span class="badge badge-success">Created</span>';
        }else if($this->status == 2){
            return '<span class="badge badge-primary">bonus sent</span>';
        }else{
            return '';
        }
    }
    public function detail(){
        $data = json_decode($this->detail,true);
        $rs = '<p>'.$data['left'].' | '.$data['right'].'</p> ';
        if($data['is_gold']){
            $rs .= '<span class="badge badge-warning">Gold</span>';
        }else if($this->status == 2){
            $rs .=  '<span class="badge badge-secondary">Silver</span>';
        }
        return $rs;
    }
}
