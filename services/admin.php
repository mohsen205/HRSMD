<?php
// Include the database connection file
require_once("../config/db.php");
require_once("../utils/message.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add"])) {
                // Retrieve user input
            $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
            $role = filter_var($_POST["role"], FILTER_SANITIZE_STRING);
            $status = filter_var($_POST["status"], FILTER_SANITIZE_STRING);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if the username is already taken
            $stmt = $pdo->prepare("SELECT id FROM admintb WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                // Username is already taken
                redirectWithMessage("../dashboard/addAdmin.php","Nom d'utilisateur déjà utilisé");
                exit();
            }     else {
                // Insert the new user into the database with the role
                $stmt = $pdo->prepare("INSERT INTO admintb (username, password, role,status) VALUES (:username, :password, :role,:status)");
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                $stmt->execute();
        
                // Redirect to the home page or dashboard after successful signup
                redirectWithMessage("../dashboard/addAdmin.php","Votre compte a été créé avec succès. Vous serez informé une fois approuvé par l'administrateur.");
                exit();
            }

    } elseif (isset($_POST["update"])) {
        $admin_id = filter_var($_POST["admin_id"], FILTER_SANITIZE_NUMBER_INT);
        $newUsername = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $newRole = filter_var($_POST["role"], FILTER_SANITIZE_STRING);
        $newStatus = filter_var($_POST["status"], FILTER_SANITIZE_STRING);

        // Check if the username is already taken
        $stmt = $pdo->prepare("SELECT id FROM admintb WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existingUser) {
            // Username is already taken
            redirectWithMessage("../dashboard/editAdmin.php?id=" . $admin_id,"Nom d'utilisateur déjà utilisé");
            exit();
        } else {
            // Example update query (replace with your actual query)
            $stmt = $pdo->prepare("UPDATE admintb SET username = :newUsername, role = :newRole, status = :newStatus WHERE id = :admin_id");
            $stmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
            $stmt->bindParam(':newRole', $newRole, PDO::PARAM_STR);
            $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
            $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect or handle the update completion as needed
            redirectWithMessage("../dashboard/editAdmin.php?id=" . $admin_id, "Administrateur mis à jour avec succès");
            exit();
        }
    } else {
        // Invalid request or missing necessary parameters
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
} else {
    // Handle other HTTP methods if needed
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    exit();
}
?>