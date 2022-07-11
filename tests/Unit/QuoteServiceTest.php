<?php

namespace StdGroup\Tests\Unit;

use PHPUnit\Framework\TestCase;
use StdGroup\App\QuoteService;
use InvalidArgumentException;

class QuoteServiceTest extends TestCase
{

    protected $quoteService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->quoteService = new QuoteService();
    }

    /**
     * Test calculate discount success
     *
     * @param $data
     * @param $expected
     * @dataProvider data_for_cal_discount_success
     * 
     * @return void
     */
    public function test_calculate_discount_success($data, $expected)
    {
        $result = $this->quoteService->calculateDiscount($data);
        $this->assertEquals($result, $expected);
    }

    /**
     * Test calculate discount throw exception
     *
     * @param $data
     * @dataProvider data_for_cal_discount_throw_exception
     * 
     * @return void
     */
    public function test_calculate_discount_throw_exception($data)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->quoteService->calculateDiscount($data);
    }

    /**
     * Test data success.
     *
     * @return array
     */
    public function data_for_cal_discount_success()
    {
        return [
            [
                [
                    'cravat' => 1,
                    'white_shirt' => 1,
                    'other' => 1
                ], //data
                QuoteService::CRAVAT_WHITE_SHIRT_DISCOUNT // expected
            ],
            [
                [
                    'cravat' => 2,
                    'white_shirt' => 2,
                    'other' => 1
                ],
                QuoteService::CRAVAT_WHITE_SHIRT_DISCOUNT
            ],
            [
                [
                    'cravat' => 3,
                    'white_shirt' => 4,
                    'other' => 1
                ],
                12
            ],
            [
                [
                    'cravat' => 0,
                    'white_shirt' => 0,
                    'other' => 7
                ],
                QuoteService::QUANTITY_DISCOUNT
            ],
            [
                [
                    'cravat' => 0,
                    'white_shirt' => 0,
                    'other' => 0
                ],
                0
            ],
        ];
    }

    /**
     * Test data throw exception.
     *
     * @return array
     */
    public function data_for_cal_discount_throw_exception()
    {
        return [
            [
                [
                    'cravat' => -1,
                    'white_shirt' => 1,
                    'other' => 1
                ], // data
            ],
            [
                [
                    'cravat' => 1,
                    'white_shirt' => -1,
                    'other' => 1
                ],
            ],
            [
                [
                    'cravat' => -1,
                    'white_shirt' => -1,
                    'other' => 1
                ],
            ],
            [
                [
                    'cravat' => -1,
                    'white_shirt' => -1,
                    'other' => -1
                ],
            ],
            [
                [
                    'cravat' => -1,
                    'white_shirt' => 1,
                    'other' => -1
                ],
            ],
        ];
    }
}
