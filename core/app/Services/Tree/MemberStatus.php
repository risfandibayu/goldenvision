<?php

namespace App\Services\Tree;

enum MemberStatus: string
{
    case Silver = 'silver';
    case Gold = 'gold';

    public function getRewardPrice(): int
    {
        return match ($this) {
            self::Silver => 15000,
            self::Gold => 20000
        };
    }
}
