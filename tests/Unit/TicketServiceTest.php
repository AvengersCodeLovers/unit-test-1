<?php

namespace StdGroup\Tests\Unit;

use Carbon\Carbon;
use DateTime;
use PHPUnit\Framework\TestCase;
use StdGroup\App\TicketService;
use StdGroup\App\Entity\Gender;
use StdGroup\App\Entity\TicketInfo;
use InvalidArgumentException;

class TicketServiceTest extends TestCase
{

    protected $ticketService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticketService = new TicketService();
    }

    /**
     * Test calculate price success
     *
     * @param $data
     * @param $expected
     * @dataProvider data_for_cal_price_success
     * 
     * @return void
     */
    public function test_calculate_price_success($data, $expected)
    {
        $result = $this->ticketService->calculatePrice($data);
        $this->assertEquals($result, $expected);
    }

    /**
     * Test calculate price throw exception
     *
     * @param $data
     * @dataProvider data_for_cal_price_throw_exception
     * 
     * @return void
     */
    public function test_calculate_price_throw_exception($data)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The age must be from ' . TicketService::MIN_AGE . ' to ' . TicketService::MAX_AGE);
        $this->ticketService->calculatePrice($data);
    }

    /**
     * Test data success.
     *
     * @return array
     */
    public function data_for_cal_price_success()
    {
        return [
            [
                // dayOfWeek == 3
                new TicketInfo(new DateTime('2022-07-12 13:04:16'), Gender::FEMALE, 24), //data
                TicketService::PRICE_IN_TUESDAY // expected
            ],
            [
                // age < 13
                new TicketInfo(new DateTime('2022-07-12 13:04:16'), Gender::FEMALE, 12), //data
                900 // expected
            ],
            [
                // gender === Gender::FEMALE and $dayOfWeek == 6
                new TicketInfo(new DateTime('2022-07-15 13:04:16'), Gender::FEMALE, 25), //data
                TicketService::PRICE_FEMALE_FRIDAY // expected
            ],
            [
                // gender === Gender::FEMALE and $dayOfWeek == 6 and age > 65
                new TicketInfo(new DateTime('2022-07-15 13:04:16'), Gender::FEMALE, 66), //data
                TicketService::PRICE_FEMALE_FRIDAY // expected
            ],
            [
                // age > 65
                new TicketInfo(new DateTime('2022-07-14 13:04:16'), Gender::FEMALE, 66), //data
                TicketService::PRICE_OVER_65 // expected
            ],
            [
                new TicketInfo(new DateTime('2022-07-11 13:04:16'), Gender::MALE, 14), //data
                TicketService::BASE_PRICE // expected
            ],
            [
                new TicketInfo(new DateTime('2022-07-10 13:04:16'), Gender::MALE, 15), //data
                TicketService::BASE_PRICE // expected
            ],
        ];
    }

    /**
     * Test data throw exception.
     *
     * @return array
     */
    public function data_for_cal_price_throw_exception()
    {
        return [
            [
                new TicketInfo(new DateTime('2022-07-12 08:04:20'), Gender::FEMALE, -10), //data
            ],
            [
                new TicketInfo(new DateTime('2022-08-12 13:04:16'), Gender::MALE, -1), //data
            ],
            [
                new TicketInfo(new DateTime('2022-09-12 14:04:22'), Gender::FEMALE, -20), //data
            ],
            [
                new TicketInfo(new DateTime('2022-11-12 17:04:30'), Gender::MALE, 121), //data
            ],
            [
                new TicketInfo(new DateTime('2022-12-12 13:04:16'), Gender::FEMALE, 999), //data
            ],
        ];
    }
}
