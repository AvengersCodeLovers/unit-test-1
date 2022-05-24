<?php

namespace StdGroup\Tests\Unit;

use PHPUnit\Framework\TestCase;

class DumpTest extends TestCase
{
    public function test_1_plus_1_equal_2()
    {
        // Arrange: Prepare inputs 
        // or Given: these inputs
        $inputX = 1;
        $inputY = 1;

        // Act: calculate
        // or When: adding them
        $output = $inputX + $inputY;

        // Assert: verify actual output = expected output
        // or Then: the result is expected to be
        $this->assertTrue($output === 2);
    }
}
