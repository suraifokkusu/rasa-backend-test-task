<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/config/config.php';

$maxAttempts = 5;
$attempt = 0;
$connected = false;

while ($attempt < $maxAttempts && !$connected) {
    try {
        $db = getDbConnection();
        $connected = true;
    } catch (mysqli_sql_exception $e) {
        $attempt++;
        sleep(2); // Подождать перед следующей попыткой
    }
}

if (!$connected) {
    die("Could not connect to the database. Please check your settings.");
}