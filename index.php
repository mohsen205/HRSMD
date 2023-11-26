<?php 

// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION["admin_id"]) && isset($_SESSION["username"])) {
    // User is already logged in, redirect to the dashboard
    header("Location: ./dashboard/index.php");
    exit();
}

require_once("./includes/header.php") 

?>

<div class="register">
    <div class="register-form">
        <div>
            <div class="d-flex justify-content-center">
                <img src="./assets/images/logo.jpg" alt="HRSMD" class="img-fluid" style="width:50px" />
            </div>
            <h3 class="text-center">Connexion</h3>
        </div>

        <?php if (isset($_GET['error'])): ?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php endif; ?>

        <form method="POST" action="./services/login.php">
            <div class="mb-3">
                <label for="username1" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" placeholder="Nom d'utilisateur *" name="username"
                    required />
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Mot de passe *" name="password"
                    required />
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="login">Se connecter</button>
            </div>
        </form>


    </div>
</div>

<?php require_once("./includes/footer.php") ?>