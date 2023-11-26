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
                <h1 class="mt-4">Tableau de bord</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Bienvenue <strong class="text-capitalize">
                            <?php echo $username ?> </strong></li>
                </ol>
            </div>



        </main>
    </div>
    </div>
</body>
<?php require_once("../includes/footer.php") ?>