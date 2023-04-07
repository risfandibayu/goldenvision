<?php

namespace App\Models;

use App\Enums\UserGoldReward;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'ver_code_send_at' => 'datetime'
    ];

    protected $data = [
        'data'=>1
    ];




    public function login_logs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id','desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status','!=',0);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)->where('status','!=',0);
    }

    //mlm
    public function userExtra()
    {
        return $this->hasOne(UserExtra::class);
    }

    public function userBank()
    {
        return $this->hasOne(rekening::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function golds()
    {
        return $this->hasMany(UserGold::class);
    }
    public function reward()
    {
        return $this->hasMany(ureward::class);
    }
    public function bonus(){
        return $this->hasMany(BonusUser::class);
    }

    public function dailyGolds()
    {
        return $this->golds()->where('type', UserGoldReward::Daily->value);
    }

    public function weeklyGolds()
    {
        return $this->golds()->where('type', UserGoldReward::Weekly->value);
    }

    public function getTotalDailyGoldsAttribute()
    {
        return $this->dailyGolds()->sum('golds') ?: 0;
    }

    public function getTotalWeeklyGoldsAttribute()
    {
        return $this->weeklyGolds()->sum('golds') ?: 0;
    }

    public function getTotalGoldsAttribute()
    {
        return $this->golds()->sum('golds') ?: 0;
    }


    public function getCanAddWeeklyGoldAttribute()
    {
        // return $this->total_weekly_golds ?: 0 < 0.50 && $this->total_daily_golds
    }

    public static function hasClaimedDailyGold($id)
    {
        return (new static)
            ->newModelQuery()
            ->where('id', $id)
            ->whereHas(
                'dailyGolds',
                fn ($builder) => $builder->whereDate('created_at', Carbon::now()->format('Y-m-d'))
            )
            ->exists();
    }
    public static function hasClaimedWeeklyGold($id)
    {
        return (new static)
            ->newModelQuery()
            ->where('id', $id)
            ->whereHas(
                'weeklyGolds',
                fn ($builder) => $builder->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            )
            ->exists();
    }

    public static function canClaimDailyGold($id)
    {
        $user = (new static)
            ->newModelQuery()
            ->withCount('dailyGolds')
            ->find($id);

        return  ($user?->daily_golds_count < 100) &&
                (! static::hasClaimedDailyGold($id)) &&
                // ($user?->is_kyc == 2) &&
                ($user?->no_bro != null);
    }
    public static function canClaimWeeklyGold($id)
    {
        $user = (new static)
            ->newModelQuery()
            ->withCount('dailyGolds')
            ->find($id);

        return  ($user?->daily_golds_count > 100) &&
                (! static::hasClaimedWeeklyGold($id)) &&
                // ($user?->is_kyc == 2) &&
                ($user?->no_bro != null);
    }

    public static function canAddWeeklyGold($id)
    {
        return (UserGold::dailyGoldsOf($id)->count() === 100) && (
            UserGold::weeklyGoldsOf($id)->sum('golds') < 0.50
        );
    }




    // SCOPES

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeBanned()
    {
        return $this->where('status', 0);
    }

    public function scopeEmailUnverified()
    {
        return $this->where('ev', 0);
    }

    public function scopeSmsUnverified()
    {
        return $this->where('sv', 0);
    }
    public function scopeEmailVerified()
    {
        return $this->where('ev', 1);
    }

    public function scopeSmsVerified()
    {
        return $this->where('sv', 1);
    }

    public function scopeWithGoldsTotal($builder)
    {
        $builder->addSelect([
            'total_daily_golds' => $this->aggregateGoldsReward(UserGoldReward::Daily),
            'total_weekly_golds' => $this->aggregateGoldsReward(UserGoldReward::Weekly)
        ]);
    }

    protected function aggregateGoldsReward(UserGoldReward $reward)
    {
        return fn ($builder) => $builder
            ->from('user_golds')
            ->selectRaw('sum(golds)')
            ->whereColumn('user_golds.user_id', 'users.id')
            ->where('type', $reward->value);
    }

    public static function userTree($userId){
        // dd($userId);
        $group = [];
        $user  = User::find($userId);
        $user1 = User::where('ref_id',$user->id)->get();
        $group[1] = $user1;
        $user2 = [];
        foreach ($user1 as $key => $value) {
            $user2 = User::where('ref_id',$value->id)->get(); 
        }
        $group[2] = $user2;
        $user3 = [];
        foreach ($user2 as $key => $value) {
            $user3 = User::where('ref_id',$value->id)->get(); 
        }
        $group[3] = $user3;
        $user4 = [];
        foreach ($user3 as $key => $value) {
            $user4 = User::where('ref_id',$value->id)->get(); 
        }
        $group[4] = $user4;
        $user5 = [];
        foreach ($user4 as $key => $value) {
            $user5 = User::where('ref_id',$value->id)->get(); 
        }
        $group[5] = $user5;
        return $group;
       
    }
    public function position(){
        $data = $this->position_by_ref;
        if($data == null){
            return '<span class="badge rounded-pill badge-secondary">not-set</span>';
        }elseif($data==1){
            return 'Kiri';
        }else{
            return 'Kanan';
        }
    }
    public function positionUpline(){
        $data = $this->position;
        if($data == null){
            return '<span class="badge rounded-pill badge-secondary">not-set</span>';
        }elseif($data==1){
            return 'Kiri';
        }else{
            return 'Kanan';
        }
    }

}
