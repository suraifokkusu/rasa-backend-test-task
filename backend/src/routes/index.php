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

require_once __DIR__ . '/../../vendor/autoload.php'; // путь к autoload.php от Composer
require_once __DIR__ . '/../config/config.php';

use Controllers\CheckUserController;
use Controllers\SubmitReviewController;


$db = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $controller = new CheckUserController($db);
    $response = $controller->checkUser($_GET['id']);
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['rating']) && isset($_POST['comment'])) {
    $controller = new SubmitReviewController($db);
    $response = $controller->submitReview($_POST['user_id'], $_POST['rating'], $_POST['comment']);
    echo json_encode($response);
    exit();
}

echo json_encode(['message' => 'Invalid request']);
?>
