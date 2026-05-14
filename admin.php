<?php
session_start();
require 'db_connect.php';

// SECURITY CHECK: Kick out anyone who isn't logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Fetch all messages from the database, newest first
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Messages</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container { max-width: 960px; margin: 80px auto; padding: 20px; }
        .message-card { background: var(--post-bg); border-radius: 6px; padding: 20px; margin-bottom: 20px; border: 1px solid var(--border-color); }
        .message-header { display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; margin-bottom: 15px; color: var(--text-muted); font-size: 13px; }
        .message-header strong { color: var(--link-color); }
    </style>
</head>
<body>
    <div class="tumblr-topbar">
        <div class="topbar-inner">
            <div class="logo">Dashboard</div>
            <div class="topbar-icons">
                <a href="logout.php" class="admin-link">Logout</a>
            </div>
        </div>
    </div>

    <div class="admin-container">
        <h1 style="color: var(--text-heading); margin-bottom: 30px;">Inbox</h1>

        <?php if (empty($messages)): ?>
            <p>No messages found in the database.</p>
        <?php else: ?>
            <?php foreach ($messages as $msg): ?>
                <div class="message-card">
                    <div class="message-header">
                        <span>From: <strong><?php echo htmlspecialchars($msg['name']); ?></strong> (<?php echo htmlspecialchars($msg['email']); ?>)</span>
                        <span>Date: <?php echo date('M d, Y H:i', strtotime($msg['created_at'])); ?></span>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span class="skill-tag"><?php echo htmlspecialchars($msg['reason']); ?></span>
                    </div>
                    <p style="color: var(--text-main);"><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>