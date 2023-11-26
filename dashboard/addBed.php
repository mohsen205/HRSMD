<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}

// Get the value of the username session variable
$username = $_SESSION["username"];

require_once("../includes/header.php");
?>

<body class="sb-nav-fixed">
    <?php require_once("../includes/dashboardLayout.php"); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Lits</h1>
                <ol class="breadcrumb mb-4">
                    <!-- Breadcrumb items can be added here if needed -->
                    <li class="breadcrumb-item active">Ajouter un lit</li>
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
                <form action="../services/bed.php" method="post">
                    <div class="mb-3">
                        <label for="roomNumber" class="form-label">Numéro de chambre</label>
                        <input type="text" class="form-control" id="roomNumber" name="roomNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" rows name="description"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="occupied" selected>Occupé</option>
                            <option value="available">Disponible</option>
                            <!-- Add more status options as needed -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">Ajouter le lit</button>
                </form>
            </div>
        </main>
    </div>
</body>
<?php require_once("../includes/footer.php") ?>