<?php

namespace StdGroup\App;

use Carbon\Carbon;
use StdGroup\App\Entity\Card;

class BankService
{
    const NORMAL_FEE = 110;
    const NO_FEE = 0;

    const FREE_TIME_PERIOD = ['00:00', '8:45'];

    const HOLIDAYS = ['01-01', '30-04', '01-05'];

    public function calculateFee(Card $card)
    {
        if ($card->getIsVip()) {
            return self::NO_FEE;
        }

        // Hint: https://carbon.nesbot.com/docs/#api-testing
        $today = Carbon::now();
        if (in_array($today->format('d-m'), self::HOLIDAYS) || $today->isWeekend()) {
            return self::NORMAL_FEE;
        }

        $timeNow = $today->format('H:i');
        [$minTimePeriod, $maxTimePeriod] = self::FREE_TIME_PERIOD;
        if ($timeNow >= $minTimePeriod && $timeNow <= $maxTimePeriod) {
            return self::NO_FEE;
        }

        return self::NORMAL_FEE;
    }
}
