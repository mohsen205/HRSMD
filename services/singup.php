<?php
require_once("../config/db.php");
require_once("../utils/password.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user input
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $role = filter_var($_POST["role"], FILTER_SANITIZE_STRING);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username is already taken
    $stmt = $pdo->prepare("SELECT id FROM admintb WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        // Username is already taken
        header("Location: ../signup.php?error=Nom d'utilisateur déjà utilisé");
        exit();
    } else {
        // Insert the new user into the database with the role
        $stmt = $pdo->prepare("INSERT INTO admintb (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        // Redirect to the home page or dashboard after successful signup
        header("Location: ../signup.php?success=Votre compte a été créé avec succès. Vous serez informé une fois approuvé par l'administrateur.");
        exit();
    }
} else {
    // Handle other HTTP methods if needed
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    exit();
}
?>