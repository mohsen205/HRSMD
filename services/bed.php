<?php
// Include the database connection file
require_once("../config/db.php");
require_once("../utils/message.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["add"])) {
        // Retrieve form data
        $roomNumber = filter_var($_POST["roomNumber"], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
        $status = filter_var($_POST["status"], FILTER_SANITIZE_STRING);

        // Insert data into the database
        $stmt = $pdo->prepare("INSERT INTO bedtb (roomNumber, description, status) VALUES (?, ?, ?)");

        if ($stmt->execute([$roomNumber, $description, $status])) {
            // Success: Redirect with success message
            redirectWithMessage("../dashboard/addBed.php", "Le lit a été ajouté avec succès.");
        } else {
            // Error: Redirect with error message
            redirectWithMessage("../dashboard/addBed.php", "Erreur lors de l'ajout du lit. Veuillez réessayer.");
        }

    } elseif (isset($_POST["update"])) {
        // Retrieve form data
        $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
        $status = filter_var($_POST["status"], FILTER_SANITIZE_STRING);

        // Check if roomNumber is present to determine if it's an update or insert
        $bedId = filter_var($_POST['bed_id'], FILTER_SANITIZE_STRING);

        $stmt = $pdo->prepare("UPDATE bedtb SET description=?, status=? WHERE id=?");

        if ($stmt->execute([$description, $status, $bedId])) {
            // Success: Redirect with success message
            redirectWithMessage("../dashboard/editBed.php?id=".$bedId, "Le lit a été modifié avec succès.");
        } else {
            // Error: Redirect with error message
            redirectWithMessage("../dashboard/editBed.php?id=".$bedId, "Erreur lors de la modification du lit. Veuillez réessayer.");
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