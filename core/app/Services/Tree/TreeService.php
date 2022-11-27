<?php

namespace App\Services\Tree;

use App\Models\User;
use App\Services\Tree\Enums\TreePosition;

class TreeService
{
    public function calculateUplineMemberBonus(User $user, User $refUser, TreePosition $position)
    {
        $parent = null;
        $up = 0;

        while ($up < 2) {
            $parent = User::query()
                ->where('ref_id', '>', 0)
                ->where('id', $parent?->pos_id ?: $user->pos_id)
                ->first();

            $up++;
        };

        if ($parent) {
            $firstLevel = User::where('pos_id', $parent->id)->get('id');
            $secondLevelCount = User::whereIn('pos_id', $firstLevel->pluck('id')->all())->count();

            $total = $firstLevel->count() + $secondLevelCount;

            if ($total === 6) {
                $status = MemberStatus::Silver;
                $membersCount = User::where('ref_id', $parent->id)->count();
                $bonus = $status->getRewardPrice() * $membersCount;

                $parent->member_status = $status->value;
                $parent->bonus_sponsor = $bonus;

                $parent->save();
            }
        }
    }
}
