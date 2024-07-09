<?php

use PHPUnit\Framework\TestCase;
use Models\Review;
class DatabaseTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        $this->db = getDbConnection();
        $this->db->query("CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id VARCHAR(255) NOT NULL,
            rating INT NOT NULL,
            comment TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id)
        )");
    }

    protected function tearDown(): void
    {
        $this->db->query("DROP TABLE reviews");
        $this->db->close();
    }

    public function testInsertReview()
    {
        $query = "INSERT INTO reviews (user_id, rating, comment) VALUES ('1', '5', 'Excellent service!')";
        $this->db->query($query);
        
        $result = $this->db->query("SELECT * FROM reviews WHERE user_id = '1'");
        $this->assertEquals(1, $result->num_rows);
    }
}
?>
