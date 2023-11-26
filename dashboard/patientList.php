<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}

require_once("../config/db.php");

// Get the value of the username session variable
$username = $_SESSION["username"];

$patients = [];
try {
    // Query to retrieve all patients, ordered by the most recent ones
    $sql = "SELECT * FROM patient ORDER BY createdAt DESC"; // Assuming you have a 'created_at' column indicating when the patient was added

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all rows as an associative array
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <h1 class="mt-4">Patients</h1>
            </div>
            <div class="d-flex justify-content-center">
                <?php
                if (isset($_GET['message'])) {
                    $message = urldecode($_GET['message']);
                    echo '<div class="alert alert-dismissible fade show alert-' . (strpos($message, 'succès') !== false ? 'success' : 'danger') . '" role="alert">' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                ?>
            </div>
            <div class="pe-5 ps-5 pb-2 pt-2">
                <?php if (empty($patients)) { ?>
                <div class="alert alert-info" role="alert">
                    Aucun patient n'a été ajouté. Veuillez ajouter un patient.
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom de famille</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Date de création</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Assuming $patients is an array containing patient data from the database
                                foreach ($patients as $patient) {
                                ?>
                            <tr>
                                <td><?php echo $patient['fname']; ?></td>
                                <td><?php echo $patient['lname']; ?></td>
                                <td><?php echo $patient['gender']; ?></td>
                                <td><?php echo $patient['email']; ?></td>
                                <td><?php echo $patient['contact']; ?></td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($patient['createdAt'])); ?></td>
                                <td>
                                    <a href="./editPatient.php?id=<?php echo $patient['id']; ?>" class="text-primary">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <a href="deletePatient.php?id=<?php echo $patient['id']; ?>" class="text-danger">
                                        <span class="material-symbols-outlined">delete</span>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
        </main>
    </div>
</body>
<?php require_once("../includes/footer.php") ?>