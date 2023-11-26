<?php
// Include the database connection file
require_once("../config/db.php");
require_once("../utils/message.php");

if ($_SERVER["REQUEST_METHOD"]) {

    if (isset($_POST["add"])) {
            // Retrieve form data
    $fullName = filter_var($_POST["fullName"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_var($_POST["phoneNumber"], FILTER_SANITIZE_STRING);
    $specialty = filter_var($_POST["specialty"], FILTER_SANITIZE_STRING);
    $startTime = $_POST["startTime"]; // No need to sanitize, as it's a time input
    $endTime = $_POST["endTime"]; // No need to sanitize, as it's a time input
    $shiftType = filter_var($_POST["shiftType"], FILTER_SANITIZE_STRING);

    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO doctb (fullName, email, phoneNumber, specialty, startTime, endTime, shiftType) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$fullName, $email, $phoneNumber, $specialty, $startTime, $endTime, $shiftType])) {
        // Success: Redirect with success message
        redirectWithMessage("../dashboard/addDoctor.php", "Le médecin a été ajouté avec succès.");
    } else {
        // Error: Redirect with error message
        redirectWithMessage("../dashboard/addDoctor.php", "Erreur lors de l'ajout du médecin. Veuillez réessayer.");
    }
    
    } elseif (isset($_POST["update"])) {
           // Retrieve form data
    $fullName = filter_var($_POST["fullName"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_var($_POST["phoneNumber"], FILTER_SANITIZE_STRING);
    $specialty = filter_var($_POST["specialty"], FILTER_SANITIZE_STRING);
    $startTime = $_POST["startTime"]; // No need to sanitize, as it's a time input
    $endTime = $_POST["endTime"]; // No need to sanitize, as it's a time input
    $shiftType = filter_var($_POST["shiftType"], FILTER_SANITIZE_STRING);

    // Check if doctor_id is present to determine if it's an update or insert
    $doctorId = filter_var($_POST['doctor_id'], FILTER_VALIDATE_INT);

    $stmt = $pdo->prepare("UPDATE doctb SET fullName=?, email=?, phoneNumber=?, specialty=?, startTime=?, endTime=?, shiftType=? WHERE id=?");

    if ($stmt->execute([$fullName, $email, $phoneNumber, $specialty, $startTime, $endTime, $shiftType, $doctorId])) {
        // Success: Redirect with success message
        redirectWithMessage("../dashboard/editDoctor.php?id=".$doctorId, "Le médecin a été modifié avec succès.");
    } else {
        // Error: Redirect with error message
        redirectWithMessage("../dashboard/editDoctor.php?id=".$doctorId, "Erreur lors de la modification du médecin. Veuillez réessayer.");
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