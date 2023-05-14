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
        if ($this->detail()) {
            $data = json_decode($this->detail,true);
            $rs = '<p>'.$data['left'].' | '.$data['right'].'</p> ';
            if($data['is_gold']){
                $rs .= '<span class="badge badge-warning">Gold</span>';
            }else{
                $rs .=  '<span class="badge badge-secondary">Silver</span>';
            }
        }else{
            $rs = '<span class="badge badge-secondary">Not Set</span>';
        }
        return $rs;
    }
    public function claim(){
        $data = json_decode($this->detail,true)['claim'];
        return $this->rewa->$data;
    }
    public function reward(){
        return $this->belongsTo(BonusReward::class,'reward_id');
    }
    public function details(){
        return json_decode($this->detail,true);

    }
    public static function slideUser(){
        $data = ureward::with(['user','reward'])->whereHas('reward', function ($query) {
                    return $query->where('type', '=', 'monthly');
                })
                ->orderByDesc('id')
                ->limit(3)
                ->get();
        $data2 = ureward::with(['user','reward'])->whereHas('reward', function ($query) {
                    return $query->where('type', '=', 'monthly');
                })
                ->orderByDesc('id')
                ->skip(3)
                ->limit(3)
                ->get();
        $data3 = ureward::with(['user','reward'])->whereHas('reward', function ($query) {
                    return $query->where('type', '=', 'monthly');
                })
                ->orderByDesc('id')
                ->skip(6)
                ->limit(3)
                ->get();      
        $c = $data->count();
        $rs = '';
        // dd($data);
        $rs .=  '<div class="carousel-item active">';
        $rs .=      '<div class="cards-wrapper d-flex justify-content-center">';
        foreach ($data as $key => $value) {
            $rs .=          '<div class="card mr-2 mt-3 100  h-100 bg--10 text-white b-radius--10 box-shadow">';
            $rs .=              '<div class="row card-body">';
            $rs .=                 '<img src="'.getImage("assets/images/user/profile/". $value->user->image,  null, true).'" class="col-sm-6 rounded-circle" alt="..." style="float: left;width:  80px;height: 80px;object-fit: cover;">';
            $rs .=                      '<div class="col-sm-6">';
            $rs .=                          '<h5 class="card-title">'.$value->user->username.'</h5>';
            $rs .=                          '<p class="card-text">'.$value->reward->reward.' </p>';
            $rs .=                          '<p class="card-text">'.$value->details()['left'].'|'.$value->details()['right'].' </p>';
            $rs .=                          '<p class="card-text">'.$value->details()['is_gold']?'<span class="badge rounded-pill badge-warning">Gold</span>':'<span class="badge rounded-pill badge-secondary">Silver</span></p>';
            $rs .=                      '</div>';
            $rs .=              '</div>';
            $rs .=          '</div>';
        }
        $rs .=      '</div>';
        $rs .= '</div>';
       
        if($data2->count() > 0){
            $rs .=  '<div class="carousel-item">';
            $rs .=      '<div class="cards-wrapper d-flex justify-content-center">';
            foreach ($data2 as $key => $value) {
                $rs .=          '<div class="card mr-2 mt-3 100  h-100 bg--10 text-white b-radius--10 box-shadow">';
                $rs .=              '<div class="row card-body">';
                $rs .=                 '<img src="'.getImage("assets/images/user/profile/". $value->user->image,  null, true).'" class="col-sm-6 rounded-circle" alt="..." style="float: left;width:  80px;height: 80px;object-fit: cover;">';
                $rs .=                      '<div class="col-sm-6">';
                $rs .=                          '<h5 class="card-title">'.$value->user->username.'</h5>';
                $rs .=                          '<p class="card-text">'.$value->reward->reward.' </p>';
                $rs .=                          '<p class="card-text">'.$value->details()['left'].'|'.$value->details()['right'].' </p>';
                $rs .=                          '<p class="card-text">'.$value->details()['is_gold']?'<span class="badge rounded-pill badge-warning">Gold</span>':'<span class="badge rounded-pill badge-secondary">Silver</span></p>';
                $rs .=                      '</div>';
                $rs .=              '</div>';
                $rs .=          '</div>';
            }
            $rs .=      '</div>';
            $rs .= '</div>';
        }
        if($data3->count() > 0){
            $rs .=  '<div class="carousel-item carusel3">';
            $rs .=      '<div class="cards-wrapper d-flex justify-content-center">';
            foreach ($data3 as $key => $value) {
                $rs .=          '<div class="card mr-2 mt-3 100  h-100 bg--10 text-white b-radius--10 box-shadow">';
                $rs .=              '<div class="row card-body">';
                $rs .=                 '<img src="'.getImage("assets/images/user/profile/". $value->user->image,  null, true).'" class="col-sm-6 rounded-circle" alt="..." style="float: left;width:  80px;height: 80px;object-fit: cover;">';
                $rs .=                      '<div class="col-sm-6">';
                $rs .=                          '<h5 class="card-title">'.$value->user->username.'</h5>';
                $rs .=                          '<p class="card-text">'.$value->reward->reward.' </p>';
                $rs .=                          '<p class="card-text">'.$value->details()['left'].'|'.$value->details()['right'].' </p>';
                $rs .=                          '<p class="card-text">'.$value->details()['is_gold']?'<span class="badge rounded-pill badge-warning">Gold</span>':'<span class="badge rounded-pill badge-secondary">Silver</span></p>';
                $rs .=                      '</div>';
                $rs .=              '</div>';
                $rs .=          '</div>';
            }
            $rs .=      '</div>';
            $rs .= '</div>';
        }
        return $rs;
    }
}
