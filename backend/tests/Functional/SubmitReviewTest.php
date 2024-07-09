<?php
use PHPUnit\Framework\TestCase;
class SubmitReviewTest extends TestCase
{
    private $db;
    private $includeDir;

    protected function setUp(): void
    {
        $this->includeDir = __DIR__ . '/../../src/routes/';

        $this->db = new mysqli('localhost', 'root', '', 'reviews_db');

        // Удаление таблицы для чистого тестирования
        $this->db->query("DROP TABLE IF EXISTS reviews");
        $this->db->query("DROP TABLE IF EXISTS users");

        // Создание таблиц
        $this->db->query("CREATE TABLE users (
            id VARCHAR(255) PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        )");

        $this->db->query("CREATE TABLE reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id VARCHAR(255) NOT NULL,
            rating INT NOT NULL,
            comment TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id)
        )");

        $this->db->query("INSERT INTO users (id, name) VALUES ('1', 'Test User')");
    }

    protected function tearDown(): void
    {
        $this->db->query("DROP TABLE reviews");
        $this->db->query("DROP TABLE users");
        $this->db->close();
    }

    public function testValidReviewSubmission()
    {
        echo "Starting testValidReviewSubmission\n";

        $_POST['user_id'] = '1';
        $_POST['rating'] = '5';
        $_POST['comment'] = 'Excellent service!';

        ob_start();
        include $this->includeDir . 'submit_review.php';
        $response = ob_get_clean();

        $responseArray = json_decode($response, true);

        print_r($responseArray);

        $this->assertEquals('Отзыв успешно отправлен', $responseArray['message']);
    }

    public function testInvalidRating()
    {
        echo "Starting testInvalidRating\n";

        $_POST['user_id'] = '1';
        $_POST['rating'] = '6';
        $_POST['comment'] = 'Good service';

        ob_start();
        include $this->includeDir . 'submit_review.php';
        $response = ob_get_clean();

        $responseArray = json_decode($response, true);

        print_r($responseArray);

        $this->assertEquals('Rating must be between 1 and 5.', $responseArray['message']);
    }

    public function testLongComment()
    {
        echo "Starting testLongComment\n";

        $_POST['user_id'] = '1';
        $_POST['rating'] = '5';
        $_POST['comment'] = str_repeat('A', 501);

        ob_start();
        include $this->includeDir . 'submit_review.php';
        $response = ob_get_clean();

        $responseArray = json_decode($response, true);

        print_r($responseArray);

        $this->assertEquals('Comment must be less than 500 characters.', $responseArray['message']);
    }
}
ob_end_flush();
?>