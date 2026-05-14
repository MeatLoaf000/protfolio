<?php

$host = 'sql311.infinityfree.com';
$db   = 'if0_41916228_MainBase';
$user = 'if0_41916228';
$pass = 'YOUR_DATABASE_PASSWORD';

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    
    // Set error mode to exception so we can catch database errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // If it fails, return a JSON error so our AJAX script can read it
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed.']));
}
?>