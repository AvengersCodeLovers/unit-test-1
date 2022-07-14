<?php

namespace StdGroup\Tests\Unit;

use PHPUnit\Framework\TestCase;
use StdGroup\App\UsernameValidation;

class UsernameValidationTest extends TestCase
{
    protected $usernameValidation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usernameValidation = new UsernameValidation();
    }

    /**
     * @dataProvider data_test_valid_true
     */
    public function test_is_valid_true($username): void
    {
        $result = $this->usernameValidation->isValid($username);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider data_test_valid_false
     */
    public function test_is_valid_false($username, $message): void
    {
        $result = $this->usernameValidation->isValid($username);
        $errorMessage = $this->usernameValidation->getMessage();

        $this->assertFalse($result);
        $this->assertEquals($message, $errorMessage);
    }

    public function data_test_valid_true(): array
    {
        return [
            [
                '1212415411'
            ],
            [
                'UserNamwe23'
            ],
            [
                'MyNameIs'
            ],
            [
                'Cover03924390'
            ],
            [
                'Coding-conve'
            ],
            [
                'fgdf-gfd-564'
            ],
            [
                'KJKDJSKJSK'
            ]
        ];
    }

    public function data_test_valid_false(): array
    {
        return [
            [
                'My--name',
                'Only single - is allowed'
            ],
            [
                'My-name-is-very-very-very-long',
                'Maximum length is ' . UsernameValidation::MAX_LENGTH
            ],
            [
                '',
                'Minimum length is ' . UsernameValidation::MIN_LENGTH
            ],
            [
                '-Start-with',
                '- cannot appear at begin or end of name'
            ],
            [
                'End-with-',
                '- cannot appear at begin or end of name'
            ],
            [
                '(*(*^*%^&%&^',
                'Invalid character. Use only letters, digits and -'
            ],
        ];
    }
}
