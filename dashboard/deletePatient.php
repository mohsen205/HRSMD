<?php
// Include the database connection file
require_once("../config/db.php");
require_once("../utils/message.php");

// Check if patient_id is present in the GET data
if (isset($_GET['id'])) {
    // Retrieve and sanitize the patient_id
    $patientId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute the delete query
    $stmt = $pdo->prepare("DELETE FROM patient WHERE id = ?");
    
    try {
        $pdo->beginTransaction();

        if ($stmt->execute([$patientId])) {
            // Success: Commit the transaction and redirect with success message
            $pdo->commit();
            redirectWithMessage("../dashboard/patientList.php", "Le patient a été supprimé avec succès.");
        } else {
            // Error: Rollback the transaction and redirect with error message
            $pdo->rollBack();
            redirectWithMessage("../dashboard/patientList.php", "Erreur lors de la suppression du patient. Veuillez réessayer.");
        }
    } catch (PDOException $e) {
        // Handle any exceptions and redirect with an error message
        $pdo->rollBack();
        redirectWithMessage("../dashboard/patientList.php", "Erreur de base de données lors de la suppression du patient. Veuillez réessayer.");
    }
} else {
    // Redirect with an error message if patient_id is not provided
    redirectWithMessage("../dashboard/patientList.php", "ID du patient non spécifié pour la suppression.");
}
?>