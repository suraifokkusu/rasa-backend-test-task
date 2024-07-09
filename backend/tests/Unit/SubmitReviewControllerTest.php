<?php
use PHPUnit\Framework\TestCase;
use Controllers\SubmitReviewController;
use Models\Review;

class SubmitReviewControllerTest extends TestCase
{
    private $db;
    private $stmt;

    protected function setUp(): void
    {
        $this->db = $this->createMock(\mysqli::class);
        $this->stmt = $this->createMock(\mysqli_stmt::class);

        // Настройка мок-объекта для возврата подготовленного заявления
        $this->db->method('prepare')
                 ->willReturn($this->stmt);

        // Настройка мок-объекта для возврата true при выполнении
        $this->stmt->method('execute')
                   ->willReturn(true);
    }

    public function testSubmitReviewWithValidData()
    {
        $controller = new SubmitReviewController($this->db);
        $response = $controller->submitReview('1', 5, 'Great service!');

        $this->assertEquals('success', $response['status']);
        $this->assertEquals('Отзыв успешно отправлен', $response['message']);
    }

    public function testSubmitReviewWithInvalidRating()
    {
        $controller = new SubmitReviewController($this->db);
        $response = $controller->submitReview('1', 6, 'Great service!');

        $this->assertEquals('error', $response['status']);
        $this->assertEquals('Rating must be between 1 and 5.', $response['message']);
    }
}

?>
