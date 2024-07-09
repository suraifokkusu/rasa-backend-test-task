<?php
function getDbConnection() {
    $servername = getenv('DB_HOST') ?: 'db';
    $username = getenv('DB_USER') ?: 'reviews_user';
    $password = getenv('DB_PASSWORD') ?: 'reviews_password';
    $dbname = getenv('DB_NAME') ?: 'reviews_db';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
