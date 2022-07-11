<?php

namespace StdGroup\Tests\Unit;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use StdGroup\App\BankService;
use StdGroup\App\Entity\Card;


class BankServiceTest extends  TestCase
{
    public function testCalculateFeeWithVipCard() {

        // id, isVip, time, expectResult
        $cases = [
            [1, 2, '', 0], //isVip
            [0, 0, '2022-04-30 08:45:05', 110], // holidays
            [0, 0, '2022-07-10 08:45:05', 110], // weekends
            [0, 0, '2022-07-11 06:43:05', 0], // not VIP && not holidays and weekends && time free 00:00 - 08:45
            [0, 0, '2022-07-12 23:43:05', 110], // not VIP && not weekends and holidays && out time free
        ];

        foreach ($cases as $case) {
            $bankService = new BankService();
            $card = new Card($case[0], $case[1]);
            Carbon::setTestNow($case[2]);
            $result = $bankService->calculateFee($card);
            $this->assertEquals($result, $case[3]);
        }
    }
}
