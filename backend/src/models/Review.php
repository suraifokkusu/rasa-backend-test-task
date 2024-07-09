<?php
namespace Models;

class Review {
    private $conn;
    private $table_name = "reviews";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($user_id, $rating, $comment) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, rating, comment) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->conn->error));
        }

        $stmt->bind_param("sis", $user_id, $rating, $comment);
        return $stmt->execute();
    }

    public function validateInput($user_id, $rating, $comment) {
        if ($rating < 1 || $rating > 5) {
            return ['is_valid' => false, 'message' => 'Rating must be between 1 and 5.'];
        }

        if (strlen($comment) > 500) {
            return ['is_valid' => false, 'message' => 'Comment must be less than 500 characters.'];
        }

        return ['is_valid' => true, 'message' => 'Valid input'];
    }
}
?>
