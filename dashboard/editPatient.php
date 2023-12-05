<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}

// Get the value of the username session variable
$username = $_SESSION["username"];

require_once("../config/db.php");

// Fetch patient data from the database for pre-filling the form
$editPatientId = isset($_GET['id']) ? $_GET['id'] : null;

if ($editPatientId) {
    try {
        $editPatientQuery = "SELECT * FROM patient WHERE id = ?";
        $editPatientStmt = $pdo->prepare($editPatientQuery);
        $editPatientStmt->execute([$editPatientId]);
        $editPatientData = $editPatientStmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the exception (e.g., log it, show an error message, etc.)
        echo "Error: " . $e->getMessage();
    }
}

// Fetch bed data from the database
$bedQuery = "SELECT id, roomNumber, description, status FROM bedtb";
$bedStmt = $pdo->prepare($bedQuery);
$bedStmt->execute();
$beds = $bedStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch doctor data from the database
$doctorQuery = "SELECT id, fullName FROM doctb";
$doctorStmt = $pdo->prepare($doctorQuery);
$doctorStmt->execute();
$doctors = $doctorStmt->fetchAll(PDO::FETCH_ASSOC);

require_once("../includes/header.php");
?>

<body class="sb-nav-fixed">
    <?php require_once("../includes/dashboardLayout.php"); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Patients</h1>
                <ol class="breadcrumb mb-4">
                    <!-- Breadcrumb items can be added here if needed -->
                    <li class="breadcrumb-item active">Modifier un patient</li>
                </ol>
            </div>
            <div class="d-flex justify-content-center">
                <?php
                if (isset($_GET['message'])) {
                    $message = urldecode($_GET['message']);
                    echo '<div style="width:350px" class="alert alert-dismissible fade show alert-' . (strpos($message, 'succès') !== false ? 'success' : 'danger') . '" role="alert">' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
                }
                ?>
            </div>
            <div class="pe-5 ps-5 pb-2 pt-2 ">
                <form action="../services/patient.php" method="post">
                    <input type="hidden" name="patient_id"
                        value="<?php echo isset($editPatientData['id']) ? $editPatientData['id'] : ''; ?>">
                    <div class="mb-3">
                        <label for="fname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="fname" name="fname"
                            value="<?php echo isset($editPatientData['fname']) ? $editPatientData['fname'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Nom de famille</label>
                        <input type="text" class="form-control" id="lname" name="lname"
                            value="<?php echo isset($editPatientData['lname']) ? $editPatientData['lname'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Genre</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="Male"
                                <?php echo (isset($editPatientData['gender']) && $editPatientData['gender'] === 'Male') ? 'selected' : ''; ?>>
                                Homme</option>
                            <option value="Female"
                                <?php echo (isset($editPatientData['gender']) && $editPatientData['gender'] === 'Female') ? 'selected' : ''; ?>>
                                Femme</option>
                            <!-- Add more gender options as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo isset($editPatientData['email']) ? $editPatientData['email'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact"
                            value="<?php echo isset($editPatientData['contact']) ? $editPatientData['contact'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="bedId" class="form-label">Choisir un lit</label>
                        <select class="form-select" id="bedId" name="bedId" required>
                            <?php foreach ($beds as $bed) : ?>
                            <option value="<?= $bed['id'] ?>"
                                <?php echo (isset($editPatientData['bedId']) && $editPatientData['bedId'] == $bed['id']) ? 'selected' : ''; ?>>
                                <?= $bed['roomNumber'] ?> - <?= $bed['description'] ?> (<?= $bed['status'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="doctorId" class="form-label">Choisir un médecin</label>
                        <select class="form-select" id="doctorId" name="doctorId" required>
                            <?php foreach ($doctors as $doctor) : ?>
                            <option value="<?= $doctor['id'] ?>"
                                <?php echo (isset($editPatientData['doctorId']) && $editPatientData['doctorId'] == $doctor['id']) ? 'selected' : ''; ?>>
                                <?= $doctor['fullName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fees" class="form-label">Frais</label>
                        <input type="text" class="form-control" id="fees" name="fees"
                            value="<?php echo isset($editPatientData['fees']) ? $editPatientData['fees'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="<?php echo isset($editPatientData['date']) ? $editPatientData['date'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Heure</label>
                        <input type="time" class="form-control" id="time" name="time"
                            value="<?php echo isset($editPatientData['time']) ? $editPatientData['time'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="patientStatus" class="form-label">Statut du patient</label>
                        <select class="form-select" id="patientStatus" name="patientStatus" required>
                            <option value="Admitted"
                                <?php echo (isset($editPatientData['patientStatus']) && $editPatientData['patientStatus'] === 'Admitted') ? 'selected' : ''; ?>>
                                Admis</option>
                            <option value="Discharged"
                                <?php echo (isset($editPatientData['patientStatus']) && $editPatientData['patientStatus'] === 'Discharged') ? 'selected' : ''; ?>>
                                Libéré</option>
                            <!-- Add more status options as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="doctorStatus" class="form-label">Statut du médecin</label>
                        <select class="form-select" id="doctorStatus" name="doctorStatus" required>
                            <option value="Available"
                                <?php echo (isset($editPatientData['doctorStatus']) && $editPatientData['doctorStatus'] === 'Available') ? 'selected' : ''; ?>>
                                Disponible</option>
                            <option value="Not Available"
                                <?php echo (isset($editPatientData['doctorStatus']) && $editPatientData['doctorStatus'] === 'Not Available') ? 'selected' : ''; ?>>
                                Non disponible</option>
                            <!-- Add more status options as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="4" name="description"
                            required><?php echo isset($editPatientData['description']) ? $editPatientData['description'] : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Modifier le patient</button>
                </form>
            </div>
                </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted text-center">2023 © Hôpital Sadok M'kaddem. Tous droits réservés. &copy; Site
                        conçu et
                        réalisé par Kohila Ameni</div>
                </div>
            </div>
        </footer>
    </div>
</body>
<?php require_once("../includes/footer.php") ?>