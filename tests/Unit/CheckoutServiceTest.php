<?php

namespace StdGroup\Tests\Unit;


use PHPUnit\Framework\TestCase;
use StdGroup\App\CheckoutService;

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
    public function test_calculate_shipping_fee_success($data, $expected): void
    {
        $result = $this->checkoutService->calculateShippingFee($data);
        $this->assertEquals($result, $expected);
    }


    /**
     * Test data success.
     *
     * @return array
     */
    public function data_calculate_shipping_fee_successs(): array
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
                    'amount' => 'abcd',
                    'premium_member' => true,
                    'shipping_express' => true,
                ],
                500
            ],
            [
                [
                    'amount' => -1000,
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
}
