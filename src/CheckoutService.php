<?php

namespace StdGroup\App;

class CheckoutService
{
    const SHIPPING_FEE = 500;
    const SHIPPING_EXPRESS_FEE = 500;
    const FREE_SHIPPING_AMOUNT = 5000;

    public function calculateShippingFee($order)
    {
        $shippingFee = self::SHIPPING_FEE;
        $shippingExpressFee = self::SHIPPING_EXPRESS_FEE;

        if ($order['amount'] >= self::FREE_SHIPPING_AMOUNT || !empty($order['premium_member'])) {
            $shippingFee = 0;
        }

        if (empty($order['shipping_express'])) {
            $shippingExpressFee = 0;
        }

        return $shippingFee + $shippingExpressFee;
    }
}
