<?php

namespace StdGroup\Tests\Unit;


use PHPUnit\Framework\TestCase;
use StdGroup\App\CheckoutService;
use InvalidArgumentException;

class CheckoutServiceTest extends TestCase
{
    protected $checkoutService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkoutService = new CheckoutService();
    }

    /**
     * Test calculate shipping fee success
     *
     * @param $data
     * @param $expected
     * @dataProvider data_calculate_shipping_fee_successs
     * 
     * @return void
     */
    public function test_calculate_shipping_fee_success($data, $expected)
    {
        $result = $this->checkoutService->calculateShippingFee($data);
        $this->assertEquals($result, $expected);
    }

    /**
     * Test calculate shipping fee throw exception
     *
     * @param $data
     * @dataProvider data_calculate_shipping_fee_throw_exception
     * 
     * @return void
     */
    public function test_calculate_shipping_fee_throw_exception($data)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->checkoutService->calculateShippingFee($data);
    }


    /**
     * Test data success.
     *
     * @return array
     */
    public function data_calculate_shipping_fee_successs()
    {
        return [
            [
                [
                    'amount' => 10,
                    'premium_member' => true,
                    'shipping_express' => true,
                ],
                500
            ],
            [
                [
                    'amount' => 10,
                    'premium_member' => false,
                    'shipping_express' => true,
                ],
                1000
            ],
            [
                [
                    'amount' => 10,
                    'premium_member' => false,
                    'shipping_express' => false,
                ],
                500
            ],
            [
                [
                    'amount' => 10,
                    'premium_member' => true,
                    'shipping_express' => false,
                ],
                0
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => true,
                    'shipping_express' => true,
                ],
                500
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => false,
                    'shipping_express' => true,
                ],
                500
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => false,
                    'shipping_express' => false,
                ],
                0
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => true,
                    'shipping_express' => false,
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
    public function data_calculate_shipping_fee_throw_exception()
    {
        return [
            [
                [
                    'amount' => -1000,
                    'premium_member' => true,
                    // 'shipping_express' => true,
                ],
                500
            ],
            [
                [
                    'amount' => 10,
                    // 'premium_member' => false,
                    'shipping_express' => true,
                ],
                1000
            ],
            [
                [
                    'amount' => 10,
                    'premium_member' => false,
                    'shipping_express' => false,
                ],
                500
            ],
            [
                [
                    'amount' => 10,
                    'premium_member' => true,
                    'shipping_express' => false,
                ],
                0
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => true,
                    'shipping_express' => true,
                ],
                500
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => false,
                    'shipping_express' => true,
                ],
                500
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => false,
                    'shipping_express' => false,
                ],
                0
            ],
            [
                [
                    'amount' => 5005,
                    'premium_member' => true,
                    'shipping_express' => false,
                ],
                0
            ],
        ];
    }
}
