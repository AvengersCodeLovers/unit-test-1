<?php

namespace StdGroup\Tests\Unit;

use PHPUnit\Framework\TestCase;
use StdGroup\App\DumpCalculator;

class DumpCalculatorTest extends TestCase
{
    public function test_1_plus_1_equal_2()
    {
        $inputX = 1;
        $inputY = 1;

        $calculator = new DumpCalculator;
        $output = $calculator->add($inputX, $inputY);

        $this->assertTrue($output === 2);
    }
}
