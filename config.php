<?php
// config.php
// Database configuration

$host = 'localhost';
$dbname = 'music_collection';
$username = 'root';
$password = 'sesame';

try {
    // Create the connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname: " . $e->getMessage());
}
?>
