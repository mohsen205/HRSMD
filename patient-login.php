<!DOCTYPE html>
<html lang="fr">

<head>
    <title>HRSMD</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/logo.jpg" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="style2.css">

</head>
<style type="text/css">
.form-control {
    border-radius: 0.75rem;
}
</style>

<body style="background: -webkit-linear-gradient(left, #3931af, #00c6ff); background-size: cover;">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="./index.php"
                style="margin-top: 10px;margin-left:-65px;font-family: 'IBM Plex Sans', sans-serif;">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="./assets/images/logo.jpg" alt="Hôpital régional Sadok Mokaddem à Djerba"
                        style="width:50px; border-radius:15px" />
                    &nbsp;
                    <h4 class="d-none d-lg-block">Hôpital régional Sadok Mokaddem à Djerba</h4>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" style="margin-right: 40px;">
                        <a class="nav-link js-scroll-trigger" href="index.php"
                            style="color: white;font-family: 'IBM Plex Sans', sans-serif;">
                            <h6>ACCUEIL</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="contact.html"
                            style="color: white;font-family: 'IBM Plex Sans', sans-serif;">
                            <h6>CONTACT</h6>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container patient-login">
        <div class="login-form" style="font-family: 'IBM Plex Sans', sans-serif; margin: auto; width: 50%;">
            <h3 class="text-center">Connexion Patient</h3>
            <form method="POST" class="" action="func.php">
                <div class="form-group">
                    <label>Adresse e-mail : </label>
                    <input type="text" name="email" class="form-control" placeholder="entrez votre adresse e-mail"
                        required />
                </div>

                <div class="form-group">
                    <label>Mot de passe : </label>
                    <input type="password" class="form-control" name="password2" placeholder="entrez votre mot de passe"
                        required />
                </div>
                <div class="d-flex justify-content-center w-100">
                    <button type="submit" class="btnRegister" name="inputbtn" onclick="return checklen();">
                        Connexion </button>
                </div>
            </form>
        </div>
    </div>
    </div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>
</body>

</html>