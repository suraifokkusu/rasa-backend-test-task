<?php
use PHPUnit\Framework\TestCase;
use Models\Review;

class ValidateInputTest extends TestCase
{
    public function testValidInput()
    {
        $review = new Review($this->createMock(\mysqli::class));
        $result = $review->validateInput('1', 5, 'Great service!');
        $this->assertTrue($result['is_valid']);
        $this->assertEquals('Valid input', $result['message']);
    }

    public function testInvalidRating()
    {
        $review = new Review($this->createMock(\mysqli::class));
        $result = $review->validateInput('1', 6, 'Great service!');
        $this->assertFalse($result['is_valid']);
        $this->assertEquals('Rating must be between 1 and 5.', $result['message']);
    }

    public function testLongComment()
    {
        $review = new Review($this->createMock(\mysqli::class));
        $result = $review->validateInput('1', 5, str_repeat('a', 501));
        $this->assertFalse($result['is_valid']);
        $this->assertEquals('Comment must be less than 500 characters.', $result['message']);
    }
}
