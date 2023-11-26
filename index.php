<!DOCTYPE html>
<html lang="fr">

<head>
    <title>HRSMD</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/logo.jpg" />
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/custom-style/home.css">
</head>

<body>

    <div class="register">
        <div>
            <div class="d-flex justify-content-center">
                <img src="./assets/images/logo.jpg" alt="HRSMD" class="img-fluid" style="width:50px" />
            </div>
            <h3 class="text-center">Connexion</h3>
        </div>
        <form method="POST" action="./logic/home-login.php">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nom d'utilisateur *" name="username1"
                    onkeydown="return alphaOnly(event);" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control my-2" placeholder="Mot de passe *" name="password2"
                    required />
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-circle" name="login">Se connecter</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
    const check = () => {
        if (document.getElementById('password').value ==
            document.getElementById('cpassword').value) {
            document.getElementById('message').style.color = '#5dd05d';
            document.getElementById('message').innerHTML = 'Matched';
        } else {
            document.getElementById('message').style.color = '#f55252';
            document.getElementById('message').innerHTML = 'Not Matching';
        }
    }

    const alphaOnly = (event) => {
        var key = event.keyCode;
        return ((key >= 65 && key <= 90) || key == 8 || key == 32);
    };

    const checklen = () => {
        var pass1 = document.getElementById("password");
        if (pass1.value.length < 6) {
            alert("Password must be at least 6 characters long. Try again!");
            return false;
        }
    }
    </script>
</body>

</html>