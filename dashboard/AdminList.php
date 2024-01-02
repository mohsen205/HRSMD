<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
    header("Location: ../index.php");
    exit();
}

if ($_SESSION["role"] !== "super_admin") {
    header("Location: ../index.php");
    exit();
}

require_once("../config/db.php");

// Get the value of the username session variable
$username = $_SESSION["username"];

$admins = [];
try {
    // Query to retrieve all beds,
    $sql = "SELECT id, username, role, status,createdAt FROM admintb WHERE role != 'super_admin' ORDER BY createdAt DESC";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all rows as an associative array
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <?php if (empty($admins)) { ?>
                <div class="alert alert-info" role="alert">
                    Aucun lit n'a été ajouté. Veuillez ajouter un Administrateur.
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom d'utilisateur</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Date de création</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($admins as $admin) {
                                ?>
                            <tr>
                                <td><?php echo $admin['id']; ?></td>
                                <td><?php echo $admin['username']; ?></td>
                                <td><?php echo $admin['role']; ?></td>
                                <td><?php echo ($admin['status'] === 'approved') ? 'Approuvé' : 'En attente'; ?></td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($admin['createdAt'])); ?></td>
                                <td>
                                    <a href="./editAdmin.php?id=<?php echo $admin['id']; ?>" class="text-primary">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <a href="deleteAdmin.php?id=<?php echo $admin['id']; ?>" class="text-danger">
                                        <span class="material-symbols-outlined">delete</span>
                                    </a>
                                    <a href="confirmAdmin.php?id=<?php echo $admin['id']; ?>&action=approve"
                                        class="text-success">
                                        <span class="material-symbols-outlined">
                                            how_to_reg
                                        </span>
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