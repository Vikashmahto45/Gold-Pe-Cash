<?php
// includes/db.php

$host = 'localhost';
$dbname = 'u769307048_globalwebify18';
$username = 'u769307048_globalwebify18';
$password = 'Admin@12312332';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $pdo = null;
}
?>