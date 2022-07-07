<?php

namespace StdGroup\App;

use InvalidArgumentException;

class QuoteService
{
    const CRAVAT_WHITE_SHIRT_DISCOUNT = 5;
    const QUANTITY_DISCOUNT = 7;
    const TOTAL_PRODUCT_TO_DISCOUNT = 7;

    /**
     * Calculate discount by products
     *
     * @param $productsCount ['cravat' => 0, 'white_shirt' => 1, 'other' => 2]
     * @return mixed
     */
    public function calculateDiscount($productsCount)
    {
        $cravat = $productsCount['cravat'];
        $whiteShirt = $productsCount['white_shirt'];
        $others = $productsCount['other'];
        $discount = 0;

        if ($cravat < 0 || $whiteShirt < 0 || $others < 0) {
            throw new InvalidArgumentException();
        }

        if ($cravat > 0 && $whiteShirt > 0) {
            $discount = self::CRAVAT_WHITE_SHIRT_DISCOUNT;
        }

        if (($cravat + $whiteShirt + $others) >= self::TOTAL_PRODUCT_TO_DISCOUNT) {
            $discount += self::QUANTITY_DISCOUNT;
        }

        return $discount;
    }
}
