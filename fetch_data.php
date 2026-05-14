<?php
// fetch_data.php
require 'db_connect.php';

// Tell the browser we are sending data, not HTML
header('Content-Type: application/json');

$type = $_GET['type'] ?? '';

if ($type === 'skills') {
    // Grab all skills from the database
    $stmt = $pdo->query("SELECT skill_name FROM skills");
    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
    
} elseif ($type === 'projects') {
    // Grab all projects, newest first
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    
} else {
    echo json_encode([]);
}
?>