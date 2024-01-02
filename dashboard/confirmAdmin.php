<?php
// Include the database connection file
require_once("../config/db.php");
require_once("../utils/message.php");

// Check if admin_id and action are present in the GET data
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === 'approve') {
    // Retrieve and sanitize the admin_id
    $adminId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute the update query
    $stmt = $pdo->prepare("UPDATE admintb SET status = 'approved' WHERE id = ?");
    
    try {
        $pdo->beginTransaction();

        if ($stmt->execute([$adminId])) {
            // Success: Commit the transaction and redirect with success message
            $pdo->commit();
            redirectWithMessage("../dashboard/adminList.php", "L'administrateur a été approuvé avec succès.");
        } else {
            // Error: Rollback the transaction and redirect with error message
            $pdo->rollBack();
            redirectWithMessage("../dashboard/adminList.php", "Erreur lors de l'approbation de l'administrateur. Veuillez réessayer.");
        }
    } catch (PDOException $e) {
        // Handle any exceptions and redirect with an error message
        $pdo->rollBack();
        redirectWithMessage("../dashboard/adminList.php", "Erreur de base de données lors de l'approbation de l'administrateur. Veuillez réessayer.");
    }
} else {
    // Redirect with an error message if admin_id or action is not provided
    redirectWithMessage("../dashboard/adminList.php", "ID de l'administrateur ou action non spécifiés pour l'approbation.");
}
?>