<?php
// Include the database connection file
require_once("../config/db.php");
require_once("../utils/message.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["add"])) {
        // Retrieve form data
        $fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
        $lname = filter_var($_POST["lname"], FILTER_SANITIZE_STRING);
        $gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $contact = filter_var($_POST["contact"], FILTER_SANITIZE_STRING);
        $bedId = filter_var($_POST["bedId"], FILTER_SANITIZE_NUMBER_INT);
        $doctorId = filter_var($_POST["doctorId"], FILTER_SANITIZE_NUMBER_INT);
        $fees = filter_var($_POST["fees"], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST["date"], FILTER_SANITIZE_STRING);
        $time = filter_var($_POST["time"], FILTER_SANITIZE_STRING);
        $patientStatus = filter_var($_POST["patientStatus"], FILTER_SANITIZE_STRING);
        $doctorStatus = filter_var($_POST["doctorStatus"], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);

        // Insert data into the database
        $stmt = $pdo->prepare("INSERT INTO patient (fname, lname, gender, email, contact, bedId, doctorId, fees, date, time, patientStatus, doctorStatus, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt->execute([$fname, $lname, $gender, $email, $contact, $bedId, $doctorId, $fees, $date, $time, $patientStatus, $doctorStatus, $description])) {
            // Success: Redirect with success message
            redirectWithMessage("../dashboard/addPatient.php", "Le patient a été ajouté avec succès.");
        } else {
            // Error: Redirect with error message
            redirectWithMessage("../dashboard/addPatient.php", "Erreur lors de l'ajout du patient. Veuillez réessayer.");
        }

    } elseif (isset($_POST["update"])) {
        // Retrieve form data
        $fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
        $lname = filter_var($_POST["lname"], FILTER_SANITIZE_STRING);
        $gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $contact = filter_var($_POST["contact"], FILTER_SANITIZE_STRING);
        $bedId = filter_var($_POST["bedId"], FILTER_SANITIZE_NUMBER_INT);
        $doctorId = filter_var($_POST["doctorId"], FILTER_SANITIZE_NUMBER_INT);
        $fees = filter_var($_POST["fees"], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST["date"], FILTER_SANITIZE_STRING);
        $time = filter_var($_POST["time"], FILTER_SANITIZE_STRING);
        $patientStatus = filter_var($_POST["patientStatus"], FILTER_SANITIZE_STRING);
        $doctorStatus = filter_var($_POST["doctorStatus"], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
        $patientId = filter_var($_POST['patient_id'], FILTER_SANITIZE_NUMBER_INT);

        // Update data in the database
        $stmt = $pdo->prepare("UPDATE patient SET fname=?, lname=?, gender=?, email=?, contact=?, bedId=?, doctorId=?, fees=?, date=?, time=?, patientStatus=?, doctorStatus=?, description=? WHERE id=?");

        if ($stmt->execute([$fname, $lname, $gender, $email, $contact, $bedId, $doctorId, $fees, $date, $time, $patientStatus, $doctorStatus, $description, $patientId])) {
            // Success: Redirect with success message
            redirectWithMessage("../dashboard/editPatient.php?id=".$patientId, "Le patient a été modifié avec succès.");
        } else {
            // Error: Redirect with error message
            redirectWithMessage("../dashboard/editPatient.php?id=".$patientId, "Erreur lors de la modification du patient. Veuillez réessayer.");
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