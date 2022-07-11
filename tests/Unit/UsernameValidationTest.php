<?php

namespace StdGroup\Tests\Unit;

use PHPUnit\Framework\TestCase;
use StdGroup\App\UsernameValidation;
use Mockery;
class UsernameValidationTest extends TestCase
{

    protected $usernameValidation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usernameValidation = new UsernameValidation();
    }

    /**
     * Test is valid is true
     *
     * @param $data
     * @dataProvider data_for_is_valid_true
     * 
     * @return void
     */
    public function test_is_valid_true($data)
    {
        $result = $this->usernameValidation->isValid($data);
        $this->assertTrue($result);
    }

    /**
     * Test get message
     *
     * @return void
     */
    public function test_get_message()
    {
        $message = '';
        $m = Mockery::mock(UsernameValidation::class);
        $m->shouldReceive('isValid')->with(
            Mockery::on(function(&$message) {
                $message = 123;
                return false;
            }),
            Mockery::any()
        );

        $result = $this->usernameValidation->getMessage();
        $this->assertEquals($message,$result);
    }

    /**
     * Test is valid is false
     *
     * @param $data
     * @dataProvider data_for_is_valid_false
     * 
     * @return void
     */
    public function test_is_valid_false($data)
    {
        $result = $this->usernameValidation->isValid($data);
        $this->assertFalse($result);
    }

    /**
     * Test data true.
     *
     * @return array
     */
    public function data_for_is_valid_true()
    {
        return [
            [
                'BangSquad004'
            ],
            [
                'HydrawX'
            ],
            [
                'Zomboy'
            ],
            [
                'Say-My-Name'
            ],
            [
                '00123-837-4292'
            ],
            [
                '2838782923'
            ],
            [
                'MADEINCHINA'
            ]
        ];
    }

    /**
     * Test data false.
     *
     * @return array
     */
    public function data_for_is_valid_false()
    {
        return [
            [
                null
            ],
            [
                '-Hydraw'
            ],
            [
                'Hydraw-'
            ],
            [
                'GGWP##'
            ],
            [
                'ThisIsAStringWithLengthMoreThan20Character'
            ],
            [
                'Hydraw--X'
            ],
            [
                '!@#$%^&*()'
            ],
        ];
    }
}
