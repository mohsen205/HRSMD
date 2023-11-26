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
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="specialty" class="form-label">Spécialité</label>
                        <select class="form-select" id="specialty" name="specialty" required>
                            <option value="general" selected>Généraliste</option>
                            <option value="cardiology">Cardiologue</option>
                            <!-- Add more specialties as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Heure de début</label>
                        <input type="time" class="form-control" id="startTime" name="startTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="endTime" class="form-label">Heure de fin</label>
                        <input type="time" class="form-control" id="endTime" name="endTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="shiftType" class="form-label">Type de quart</label>
                        <select class="form-select" id="shiftType" name="shiftType" required>
                            <option value="morning" selected>Matin</option>
                            <option value="afternoon">Après-midi</option>
                            <option value="evening">Soir</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">Ajouter le médecin</button>
                </form>
            </div>

        </main>
    </div>
    </div>
</body>
<?php require_once("../includes/footer.php") ?>