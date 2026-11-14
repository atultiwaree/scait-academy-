<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$db   = getenv('DB_NAME') ?: 'stoodooc_scait';

// Try standard local connection first, fallback to original credentials if needed
$con = @mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    $con = @mysqli_connect('localhost', 'stoodooc_scait', 'A2ul@fuck', 'stoodooc_scait');
}
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
