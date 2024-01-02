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
                    <div class="mb-3">
                        <label for="username1" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" placeholder="Nom d'utilisateur *"
                            name="username" required />
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Sélectionnez le rôle dans les soins de santé</label>
                        <select class="form-select control" id="role" name="role" required>
                            <option value="doctor">Docteur</option>
                            <option value="nurse">Infirmière</option>
                            <option value="pharmacist">Pharmacien</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" placeholder="Mot de passe *"
                            name="password" required />
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Sélectionnez le rôle dans les soins de santé</label>
                        <select class="form-select control" id="status" name="status" required>
                            <option value="pending">En attente</option>
                            <option value="approved">Approuvé</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">ajouter un administrateur</button>
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