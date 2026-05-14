<?php
session_start();
require 'db_connect.php';

$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch the admin user from the database
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password (using PHP's secure password_verify function)
    if ($user && password_verify($password, $user['password'])) {
        // Success! Set the session variable
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user['username'];
        
        // Redirect to the dashboard
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | System Access</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Quick centered layout for the login box */
        body { display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { width: 100%; max-width: 400px; padding: 30px; }
    </style>
</head>
<body>
    <div class="tumblr-post login-box">
        <div class="post-content">
            <h2>Dashboard Access</h2>
            <p class="ask-subtitle">Authorized personnel only.</p>
            
            <?php if ($error): ?>
                <p style="color: #EF4444; margin-bottom: 15px; font-size: 14px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" action="login.php" class="contact-form">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                
                <div class="ask-footer" style="margin-top: 15px;">
                    <a href="index.html" style="color: var(--text-muted); text-decoration: none; margin-right: 15px; display: flex; align-items: center;">Cancel</a>
                    <button type="submit" class="submit-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>