<?php
require_once("../config/db.php");
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Close the database connection
$pdo = null;

// Redirect to the login page
header("Location: ../index.php");
exit();
?>