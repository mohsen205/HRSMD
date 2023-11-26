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

$beds = [];
try {
    // Query to retrieve all beds, ordered by the most recent ones
    $sql = "SELECT * FROM bedtb ORDER BY createdAt DESC"; // Assuming you have a 'created_at' column indicating when the bed was added

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all rows as an associative array
    $beds = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <h1 class="mt-4">Lits</h1>
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
                <?php if (empty($beds)) { ?>
                <div class="alert alert-info" role="alert">
                    Aucun lit n'a été ajouté. Veuillez ajouter un lit.
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Numéro de chambre</th>
                                <th scope="col">Description</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Date de création</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Assuming $beds is an array containing bed data from the database
                                foreach ($beds as $bed) {
                                ?>
                            <tr>
                                <td><?php echo $bed['roomNumber']; ?></td>
                                <td><?php echo $bed['description']; ?></td>
                                <td><?php echo ($bed['status'] === 'occupied') ? 'Occupé' : 'Disponible'; ?></td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($bed['createdAt'])); ?></td>
                                <td>
                                    <a href="./editBed.php?id=<?php echo $bed['id']; ?>" class="text-primary">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <a href="deleteBed.php?id=<?php echo $bed['id']; ?>" class="text-danger">
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