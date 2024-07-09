<?php
namespace Controllers;

use Models\Review;

class SubmitReviewController {
    private $review;

    public function __construct($db) {
        $this->review = new Review($db);
    }

    public function submitReview($user_id, $rating, $comment) {
        if ($rating < 1 || $rating > 5) {
            return ['status' => 'error', 'message' => 'Rating must be between 1 and 5.'];
        }

        if (strlen($comment) > 500) {
            return ['status' => 'error', 'message' => 'Comment must be less than 500 characters.'];
        }

        if ($this->review->insert($user_id, $rating, $comment)) {
            return ['status' => 'success', 'message' => 'Отзыв успешно отправлен'];
        } else {
            return ['status' => 'error', 'message' => 'Error: Could not submit review'];
        }
    }
}

?>
