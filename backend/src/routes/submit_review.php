<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');
// Обработка preflight-запросов OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}
require_once __DIR__ . '/../config/config.php';

use Models\Review;

$user_id = $_POST['user_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Логирование входных данных
error_log("Received POST data: user_id=$user_id, rating=$rating, comment=$comment");

// Проверка входных данных
if ($rating < 1 || $rating > 5) {
    error_log("Invalid rating: $rating");
    echo json_encode(['message' => 'Rating must be between 1 and 5.']);
    exit();
}

if (strlen($comment) > 500) {
    error_log("Comment too long: " . strlen($comment) . " characters");
    echo json_encode(['message' => 'Comment must be less than 500 characters.']);
    exit();
}

$conn = getDbConnection();

$sql = "INSERT INTO reviews (user_id, rating, comment) VALUES ('$user_id', '$rating', '$comment')";

if ($conn->query($sql) === TRUE) {
    error_log("Review inserted successfully");
    echo json_encode(['message' => 'Отзыв успешно отправлен']);
} else {
    error_log("Error inserting review: " . $conn->error);
    echo json_encode(['message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
