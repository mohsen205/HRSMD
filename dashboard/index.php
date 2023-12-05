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
  
  // Fetch the counts from the database
try {

    $doctorCount = 0;
    $bedCount = 0;
    $patientCount = 0;

    // Count of doctors
    $stmtDoctor = $pdo->query("SELECT COUNT(*) FROM doctb");
    $doctorCount = $stmtDoctor->fetchColumn();

    // Count of beds
    $stmtBed = $pdo->query("SELECT COUNT(*) FROM bedtb");
    $bedCount = $stmtBed->fetchColumn();

    // Count of patients
    $stmtPatient = $pdo->query("SELECT COUNT(*) FROM patient");
    $patientCount = $stmtPatient->fetchColumn();
} catch (PDOException $e) {
    // Handle the exception (e.g., log it, show an error message, etc.)
    echo $e->getMessage();
}


// Fetch bed data
try {
    $bedSql = "SELECT * FROM bedtb LIMIT 8";
    $bedStmt = $pdo->prepare($bedSql);
    $bedStmt->execute();
    $beds = $bedStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle the exception (e.g., log it, show an error message, etc.)
    echo "Error fetching bed data: " . $e->getMessage();
    $beds = [];
}

// Fetch doctor data
try {
    $doctorSql = "SELECT * FROM doctb LIMIT 8";
    $doctorStmt = $pdo->prepare($doctorSql);
    $doctorStmt->execute();
    $doctors = $doctorStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle the exception (e.g., log it, show an error message, etc.)
    echo "Error fetching doctor data: " . $e->getMessage();
    $doctors = [];
}


try {
    $stmtPatients = $pdo->prepare("SELECT * FROM patient ORDER BY createdAt DESC LIMIT 25");
    $stmtPatients->execute();
    $patients = $stmtPatients->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle the exception (e.g., log it, show an error message, etc.)
    echo $e->getMessage();
}

require_once("../includes/header.php"); 


?>

<body class="sb-nav-fixed">
    <?php require_once("../includes/dashboardLayout.php"); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tableau de bord</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Bienvenue <strong class="text-capitalize">
                            <?php echo $username ?> </strong></li>
                </ol>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card  text-white mb-4"
                            style="background: linear-gradient(to right, rgb(57, 49, 175), rgb(0, 198, 255))">
                            <div class="card-body">Nombre de médecins: <strong><?php echo $doctorCount; ?></strong>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./doctorsList.php">Voir les
                                    détails</a>
                                <div class="small text-white"><span class="material-symbols-outlined">
                                        chevron_right
                                    </span></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <div class="card text-white mb-4"
                            style="background: linear-gradient(to right, rgb(57, 49, 175), rgb(0, 198, 255))">
                            <div class="card-body">Nombre de lits: <strong><?php echo $bedCount; ?></strong></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./bedList.php">Voir les détails</a>
                                <div class="small text-white"><span class="material-symbols-outlined">
                                        chevron_right
                                    </span></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <div class="card text-white mb-4"
                            style="background: linear-gradient(to right, rgb(57, 49, 175), rgb(0, 198, 255)) ">
                            <div class="card-body">Nombre de
                                patients: <strong><?php echo $patientCount; ?></strong></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./patientList.php">Voir les détails</a>
                                <div class="small text-white"><span class="material-symbols-outlined">
                                        chevron_right
                                    </span></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <span class="material-symbols-outlined">
                                    moving_beds
                                </span>
                                Lit
                            </div>
                            <div class="card-body">
                                <?php if (!empty($beds)) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Numéro de chambre</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Statut</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($beds as $bed) { ?>
                                        <tr>
                                            <td><?php echo $bed['roomNumber']; ?></td>
                                            <td><?php echo $bed['description']; ?></td>
                                            <td><?php echo ($bed['status'] === 'occupied') ? 'Occupé' : 'Disponible'; ?>
                                            </td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                <p>Aucune donnée de lit disponible.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <span class="material-symbols-outlined">
                                    pacemaker
                                </span>
                                Médecin
                            </div>
                            <div class="card-body">
                                <?php if (!empty($doctors)) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom complet</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Numéro de téléphone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($doctors as $doctor) { ?>
                                        <tr>
                                            <td><?php echo $doctor['fullName']; ?></td>
                                            <td><?php echo $doctor['email']; ?></td>
                                            <td><?php echo $doctor['phoneNumber']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                <p>Aucun dossier patient trouvé.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card mb-4">
                    <div class="card-header">
                        <span class="material-symbols-outlined">
                            clinical_notes
                        </span>
                        Patients
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <?php if (empty($patients)) { ?>
                            <p>No patient records found.</p>
                            <?php } else { ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Prénom</th>
                                            <th scope="col">Nom de famille</th>
                                            <th scope="col">Genre</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">ID du lit</th>
                                            <th scope="col">ID du médecin</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($patients as $patient) { ?>
                                        <tr>
                                            <td><?php echo $patient['id']; ?></td>
                                            <td><?php echo $patient['fname']; ?></td>
                                            <td><?php echo $patient['lname']; ?></td>
                                            <td><?php echo $patient['gender']; ?></td>
                                            <td><?php echo $patient['email']; ?></td>
                                            <td><?php echo $patient['contact']; ?></td>
                                            <td><?php echo $patient['bedId']; ?></td>
                                            <td><?php echo $patient['doctorId']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
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
    </div>
</body>
<?php require_once("../includes/footer.php") ?>