<?php

namespace StdGroup\Tests\Unit;

use PHPUnit\Framework\TestCase;
use StdGroup\App\CheckoutService;

class CheckoutServiceTest extends TestCase
{

    public function testWithPremiumMember()
    {
        // premium_member, amount, shipping_express, expectResult

        $cases = [
                    [0, 5555,0, 0], // not premium_member && exceed amount && not shipping_express
                    [0, 1, 0, 500], // not premium_member && don't exceed amount && not shipping_express
                    [1, 5555, 0, 0], // premium_member && exceed amount && not shipping_express
                    [1, 1, 0, 0], // premium_member && don't exceed amount && not shipping_express
                    [0, 5555, 1, 500], // not premium_member && exceed amount && shipping_express
                    [0, 1, 1, 1000], // not premium_member && don't exceed amount && shipping_express
                    [1, 5555, 1, 500], // premium_member && exceed amount && shipping_express
                    [1, 1, 1, 500], // premium_member && don't exceed amount && shipping_express
                ];
        foreach ($cases as $case) {
            $order = [
                'premium_member' => $case[0],
                'amount' => $case[1],
                'shipping_express' => $case[2],
            ];
            $checkoutService = new CheckoutService();
            $fee = $checkoutService->calculateShippingFee($order);
            $this->assertEquals($fee, $case[3]);
        }
    }
}
