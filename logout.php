<?php
session_start();
// Destroy all session data
session_unset();
session_destroy();

// Send them back to the main portfolio page
header("Location: index.html");
exit;
?>