<?php
    // Include the database connection file
    require_once("../config/db.php");
    require_once("../utils/message.php");

    // Check if doctor_id is present in the POST data
    if (isset($_GET['id'])) {
        // Retrieve and sanitize the doctor_id
        $doctorId = $_GET['id'];
        
        // Prepare and execute the delete query
        $stmt = $pdo->prepare("DELETE FROM doctb WHERE id = ?");
        if ($stmt->execute([$doctorId])) {
            // Success: Redirect with success message
            redirectWithMessage("../dashboard/doctorsList.php", "Le médecin a été supprimé avec succès.");
        } else {
            // Error: Redirect with error message
            redirectWithMessage("../dashboard/doctorsList.php", "Erreur lors de la suppression du médecin. Veuillez réessayer.");
        }
    } else {
        // Redirect with an error message if doctor_id is not provided
        redirectWithMessage("../dashboard/doctorsList.php", "ID du médecin non spécifié pour la suppression.");
    }

?>