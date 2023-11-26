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
  
  $doctors = [];
    try {
            // Query to retrieve all doctors, ordered by the most recent ones
            $sql = "SELECT * FROM doctb ORDER BY createdAt DESC"; // Assuming you have a 'created_at' column indicating when the doctor was added

            // Prepare and execute the query
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all rows as an associative array
            $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
            // Handle the exception (e.g., log it, show an error message, etc.)
            echo($e);
        return $doctors;
    }

    require_once("../includes/header.php"); 
?>

<body class="sb-nav-fixed">
    <?php require_once("../includes/dashboardLayout.php"); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Médecin</h1>
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
                <?php if (empty($doctors)) { ?>
                <div class="alert alert-info" role="alert">
                    Aucun médecin n'a été ajouté. Veuillez ajouter un médecin.
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">Nom complet</th>
                                <th scope="col">Adresse e-mail</th>
                                <th scope="col">Numéro de téléphone</th>
                                <th scope="col">Spécialité</th>
                                <th scope="col">Heure de début</th>
                                <th scope="col">Heure de fin</th>
                                <th scope="col">Type de quart</th>
                                <th scope="col">Date de création</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        // Assuming $doctors is an array containing doctor data from the database
                        foreach ($doctors as $doctor) {
                            // Translate shift types
                            $shiftTranslation = [
                                'morning' => 'Matin',
                                'afternoon' => 'Après-midi',
                                'evening' => 'Soir'
                            ];

                            // Format created_at to human-readable date
                            $createdAt = date('d-m-Y H:i:s', strtotime($doctor['createdAt']));
                        ?>
                            <tr>
                                <td><?php echo $doctor['fullName']; ?></td>
                                <td><?php echo $doctor['email']; ?></td>
                                <td><?php echo $doctor['phoneNumber']; ?></td>
                                <td><?php echo $doctor['specialty']; ?></td>
                                <td><?php echo $doctor['startTime']; ?></td>
                                <td><?php echo $doctor['endTime']; ?></td>
                                <td><?php echo $shiftTranslation[$doctor['shiftType']]; ?></td>
                                <td><?php echo $createdAt; ?></td>
                                <td>
                                    <a href="./editDoctor.php?id=<?php echo $doctor['id']; ?>" class="text-primary">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span></a>
                                    <a href="deleteDoctor.php?id=<?php echo $doctor['id']; ?>" class="text-danger"><span
                                            class="material-symbols-outlined">
                                            delete
                                        </span></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table> <?php } ?>
                </div>
            </div>
        </main>
    </div>
    </div>
</body>
<?php require_once("../includes/footer.php") ?>