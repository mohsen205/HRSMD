<?php
// Include the database connection file
require_once("../config/db.php");
require_once("../utils/message.php");

// Check if doctor_id is present in the GET data
if (isset($_GET['id'])) {
    // Retrieve and sanitize the doctor_id
    $doctorId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute the delete query
    $stmt = $pdo->prepare("DELETE FROM bedtb WHERE id = ?");
    
    try {
        $pdo->beginTransaction();

        if ($stmt->execute([$doctorId])) {
            // Success: Commit the transaction and redirect with success message
            $pdo->commit();
            redirectWithMessage("../dashboard/bedList.php", "Le médecin a été supprimé avec succès.");
        } else {
            // Error: Rollback the transaction and redirect with error message
            $pdo->rollBack();
            redirectWithMessage("../dashboard/bedList.php", "Erreur lors de la suppression du médecin. Veuillez réessayer.");
        }
    } catch (PDOException $e) {
        // Handle any exceptions and redirect with an error message
        $pdo->rollBack();
        redirectWithMessage("../dashboard/bedList.php", "Erreur de base de données lors de la suppression du médecin. Veuillez réessayer.");
    }
} else {
    // Redirect with an error message if doctor_id is not provided
    redirectWithMessage("../dashboard/bedList.php", "ID du médecin non spécifié pour la suppression.");
}
?>