<?php 
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}
  // Get the value of the username session variable
  $username = $_SESSION["username"];
  $editDoctorId = $_GET['id'];
  try {
    require_once("../config/db.php");

    $sql = "SELECT * FROM doctb WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$editDoctorId]);
    $editDoctorData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle the exception (e.g., log it, show an error message, etc.)
    echo "Error: " . $e->getMessage();
}

require_once("../includes/header.php"); 
?>

<body class="sb-nav-fixed">
    <?php require_once("../includes/dashboardLayout.php"); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Médecin</h1>
                <ol class="breadcrumb mb-4">
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
                <form action="../services/doctor.php" method="post">
                    <input type="hidden" name="doctor_id" value="<?php echo $editDoctorData["id"] ?>">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="fullName" name="fullName"
                            value="<?php echo $editDoctorData["fullName"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo $editDoctorData["email"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                            value="<?php echo $editDoctorData["phoneNumber"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="specialty" class="form-label">Spécialité</label>
                        <select class="form-select" id="specialty" name="specialty"
                            value="<?php echo $editDoctorData["specialty"] ?>" required>
                            <option value="general" selected>Généraliste</option>
                            <option value="cardiology">Cardiologue</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Heure de début</label>
                        <input type="time" class="form-control" id="startTime" name="startTime"
                            value="<?php echo $editDoctorData["startTime"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="endTime" class="form-label">Heure de fin</label>
                        <input type="time" class="form-control" id="endTime" name="endTime"
                            value="<?php echo $editDoctorData["endTime"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="shiftType" class="form-label">Type de quart</label>
                        <select class="form-select" id="shiftType" name="shiftType"
                            value="<?php echo $editDoctorData["shiftType"] ?>" required>
                            <option value="morning" selected>Matin</option>
                            <option value="afternoon">Après-midi</option>
                            <option value="evening">Soir</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Sauvegarder le médecin</button>
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
    </div>
</body>
<?php require_once("../includes/footer.php") ?>