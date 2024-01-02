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

$editAdminId = $_GET['id'];

try {
    require_once("../config/db.php");

    $sql = "SELECT id, username, role, status FROM admintb  WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$editAdminId]);
    $editAdminData = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle the exception (e.g., log it, show an error message, etc.)
    echo "Error: " . $e->getMessage();
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
                <h1 class="mt-4">Administrateurs</h1>
                <ol class="breadcrumb mb-4">
                    <!-- Breadcrumb items can be added here if needed -->
                    <li class="breadcrumb-item active">Ajouter un Administrateur</li>

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
                <form method="POST" action="../services/admin.php">
                    <input type="hidden" name="admin_id" value="<?php echo $editAdminData["id"] ?>" />
                    <div class="mb-3">
                        <label for="username1" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" placeholder="Nom d'utilisateur *"
                            name="username" value="<?php echo $editAdminData["username"] ?>" required />
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Sélectionnez le rôle dans les soins de santé</label>
                        <select class="form-select control" id="role" name="role"
                            value="<?php echo $editAdminData["role"] ?>" required>
                            <option value="doctor">Docteur</option>
                            <option value="nurse">Infirmière</option>
                            <option value="pharmacist">Pharmacien</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Sélectionnez le rôle dans les soins de santé</label>
                        <select class="form-select control" id="status" value="<?php echo $editAdminData["status"] ?>"
                            name="status" required>
                            <option value="pending">En attente</option>
                            <option value="approved">Approuvé</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">ajouter un administrateur</button>
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