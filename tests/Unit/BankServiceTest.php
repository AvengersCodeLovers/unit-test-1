<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Carbon\Carbon;
use StdGroup\App\BankService;
use StdGroup\App\Entity\Card;

class BankServiceTest extends TestCase
{
    public function testNoVIPCardInNormalDayAtChargeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 7, 12, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NORMAL_FEE, $fee);
    }

    public function testNoVIPCardInWeekendAtChargeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 7, 10, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testNoVIPCardInHoliDayAtChargeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 4, 30, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testNoVIPCardInHoliDayAndWeekendAtChargeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 5, 1, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testNoVIPCardInNormalDayAtFreeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 7, 12, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NORMAL_FEE, $fee);
    }

    public function testNoVIPCardInWeekendAtFreeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 7, 10, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testNoVIPCardInHoliDayAtFreeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 4, 30, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testNoVIPCardInHoliDayAndWeekendAtFreeTimePeriod()
    {
        $card = new Card("no-vip", false);
        $testDate = Carbon::create(2022, 5, 1, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testVIPCardInNormalDayAtChargeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 7, 12, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NORMAL_FEE, $fee);
    }

    public function testVIPCardInWeekendAtChargeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 7, 10, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testVIPCardInHoliDayAtChargeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 4, 30, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testVIPCardInHoliDayAndWeekendAtChargeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 5, 1, 9, 20);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testVIPCardInNormalDayAtFreeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 7, 12, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NORMAL_FEE, $fee);
    }

    public function testVIPCardInWeekendAtFreeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 7, 10, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testVIPCardInHoliDayAtFreeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 4, 30, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }

    public function testVIPCardInHoliDayAndWeekendAtFreeTimePeriod()
    {
        $card = new Card("vip", true);
        $testDate = Carbon::create(2022, 5, 1, 8, 0);
        Carbon::setTestNow($testDate);

        $bankService = new BankService();
        $fee = $bankService->calculateFee($card);

        $this->assertEquals($bankService::NO_FEE, $fee);
    }
}
