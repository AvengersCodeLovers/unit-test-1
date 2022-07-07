<?php

namespace StdGroup\App;

use Carbon\Carbon;
use InvalidArgumentException;
use StdGroup\App\Entity\Gender;
use StdGroup\App\Entity\TicketInfo;

class TicketService
{
    const BASE_PRICE = 1800;
    const PRICE_IN_TUESDAY = 1200;
    const PRICE_FEMALE_FRIDAY = 1400;
    const PRICE_OVER_65 = 1600;
    const MIN_AGE = 0;
    const MAX_AGE = 120;

    public function calculatePrice(TicketInfo $ticketInfo)
    {
        $dayOfWeek = Carbon::parse($ticketInfo->bookingDate)->dayOfWeek + 1;
        $dataPrice = [];

        if ($ticketInfo->age < self::MIN_AGE || $ticketInfo->age > self::MAX_AGE) {
            throw new InvalidArgumentException('The age must be from ' . self::MIN_AGE . ' to ' . self::MAX_AGE);
        }

        if ($ticketInfo->age < 13) {
            return self::BASE_PRICE * 0.5;
        }

        if ($dayOfWeek == 3) {
            return  self::PRICE_IN_TUESDAY;
        }

        if ($ticketInfo->gender === Gender::FEMALE && $dayOfWeek == 6) {
            $dataPrice[] = self::PRICE_FEMALE_FRIDAY;
        }

        if ($ticketInfo->age > 65) {
            $dataPrice[] = self::PRICE_OVER_65;
        }

        return $dataPrice ? min($dataPrice) : self::BASE_PRICE;
    }
}
