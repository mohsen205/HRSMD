<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}

$editBedId = $_GET['id'];

try {
    require_once("../config/db.php");

    $sql = "SELECT * FROM bedtb WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$editBedId]);
    $editBedData = $stmt->fetch(PDO::FETCH_ASSOC);


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
                <h1 class="mt-4">Lit</h1>
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
                <form action="../services/bed.php" method="post">
                    <input type="hidden" name="bed_id" value="<?php echo $editBedData["id"] ?>">
                    <div class="mb-3">
                        <label for="roomNumber" class="form-label">Numéro de chambre</label>
                        <input type="text" class="form-control" id="roomNumber" name="roomNumber"
                            value="<?php echo $editBedData["roomNumber"] ?>" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" required>
                            <?php echo $editBedData["description"] ?>
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="occupied"
                                <?php echo ($editBedData["status"] === 'occupied') ? 'selected' : ''; ?>>Occupé</option>
                            <option value="available"
                                <?php echo ($editBedData["status"] === 'available') ? 'selected' : ''; ?>>Disponible
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Modifier le lit</button>
                </form>
            </div>

        </main>
    </div>
</body>
<?php require_once("../includes/footer.php") ?>