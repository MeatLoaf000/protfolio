<?php
// submit_form.php
require 'db_connect.php';

// Tell the browser we are sending JSON back (crucial for AJAX)
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capture data from the $_POST superglobal
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $reason = trim($_POST['reason'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Server-side validation (never trust the client side alone!)
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
        exit;
    }

    try {
        // Prepared statements prevent SQL Injection hackers
        $sql = "INSERT INTO messages (name, email, reason, message) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $reason, $message]);
        
        // Success response
        echo json_encode(['status' => 'success', 'message' => 'Message received successfully!']);
    } catch (Exception $e) {
        // Database insert failed
        echo json_encode(['status' => 'error', 'message' => 'System failure: Could not save message.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>