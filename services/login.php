<?php
require_once("../config/db.php");
require_once("../utils/password.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user input
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    // Check if the admin exists in the database
    $stmt = $pdo->prepare("SELECT id, username, password, role, status FROM admintb WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Check the status of the admin
        if ($admin['status'] === "pending") {
            header("Location: ../index.php?error=Vous n'avez pas la permission de vous connecter.");
            exit();
        }

        // Admin exists, verify the entered password
        if (verifyPassword($password, $admin['password'])) {
            // Password is correct

            // Set up a session or other authentication mechanism
            // For example, you can use $_SESSION to store user information
            session_start();
            $_SESSION["admin_id"] = $admin['id'];
            $_SESSION["username"] = $admin['username'];
            $_SESSION["role"] = $admin['role'];

            // Redirect to the home page or dashboard based on role
            if ($admin['role'] === 'admin') {
                header("Location: ../dashboard/index.php");
            } else {
                header("Location: ../dashboard/index.php");
            }
            exit();
        } else {
            // Password is incorrect
            header("Location: ../index.php?error=Mot de passe incorrect");
            exit();
        }
    } else {
        header("Location: ../index.php?error=Nom d'utilisateur introuvable");
        exit();
    }
} else {
    // Handle other HTTP methods if needed
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    exit();
}