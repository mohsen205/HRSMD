<?php 
$con=mysqli_connect("localhost","root","","myhmsdb");

include('../logic/dashboard.php');

if(isset($_POST['docsub']))
{
  $doctor=$_POST['doctor'];
  $dpassword=$_POST['dpassword'];
  $demail=$_POST['demail'];
  $spec=$_POST['special'];
  $docFees=$_POST['docFees'];
  $query="insert into doctb(username,password,email,spec,docFees)values('$doctor','$dpassword','$demail','$spec','$docFees')";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Doctor added successfully!');</script>";
  }
}


if(isset($_POST['docsub1']))
{
  $demail=$_POST['demail'];
  $query="delete from doctb where email='$demail';";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Doctor removed successfully!');</script>";
  }
  else{
    echo "<script>alert('Unable to delete!');</script>";
  }
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <title>HRSMD</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.jpg" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom-style/dashboard-home.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div>
            <a class="navbar-brand" href="#">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="../assets/images/logo.jpg" alt="Hôpital régional Sadok Mokaddem à Djerba"
                        style="width:30px; border-radius:5px" />
                    &nbsp;
                    <h4 class="d-none d-lg-block">HRSMD</h4>
                </div>

            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php"><i class="fa fa-sign-out"
                            aria-hidden="true"></i>Déconnexion</a>

                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top:50px;">
        <h3 class="text-center pt-5"> BIENVENUE RÉCEPTIONNISTE.</h3>
        <div class="row">
            <div class="col-md-4" style="max-width: 25%; margin-top: 3%;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list"
                        href="#list-dash" role="tab" aria-controls="home">Tableau de bord</a>
                    <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list" role="tab"
                        aria-controls="home" data-toggle="list">Liste des Médecins</a>
                    <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list" role="tab"
                        data-toggle="list" aria-controls="home">Liste des Patients</a>
                    <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list" role="tab"
                        data-toggle="list" aria-controls="home">Liste des Lits</a>
                    <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list"
                        role="tab" data-toggle="list" aria-controls="home">Ajouter un Médecin</a>
                    <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list"
                        role="tab" data-toggle="list" aria-controls="home">Ajouter un Patient</a>
                    <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list"
                        role="tab" data-toggle="list" aria-controls="home">Ajouter un Lit</a>
                </div>
            </div>

            <div class="col-md-8" style="margin-top: 3%;">
                <div class="tab-content" id="nav-tabContent" style="width: 950px;">
                    <div class="tab-pane fade show active" id="list-dash" role="tabpanel"
                        aria-labelledby="list-dash-list">
                        <div class="container-fluid container-fullw bg-white">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Liste des Médecins</h4>
                                            <script>
                                            function clickDiv(id) {
                                                document.querySelector(id).click();
                                            }
                                            </script>
                                            <p class="links cl-effect-1">
                                                <a href="#list-doc" onclick="clickDiv('#list-doc-list')">
                                                    Voir les médecins
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="left: -3%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Liste des Patients</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                                                    Voir les patients
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="left: -3%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Liste des Lits</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                                                    Voir les patients
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row" style="margin-top: 5%;">
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-plus fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Gérer les Médecins</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Ajouter des
                                                    Médecins</a>
                                                &nbsp;|
                                                <a href="#app-hist" onclick="clickDiv('#list-ddoc-list')">
                                                    Supprimer des Médecins
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-plus fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Gérer les Patients</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Ajouter des
                                                    Patients</a>
                                                &nbsp;|
                                                <a href="#app-hist" onclick="clickDiv('#list-ddoc-list')">
                                                    Supprimer des Patients
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-plus fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Gérer les Lits</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Ajouter des
                                                    Lit</a>
                                                &nbsp;|
                                                <a href="#app-hist" onclick="clickDiv('#list-ddoc-list')">
                                                    Supprimer des Lit
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-home-list">


                        <div class="col-md-8">
                            <form class="form-group" method="post" action="./doctor-search.php">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="doctor_contact"
                                            placeholder="Address email" class="form-control"></div>
                                    <div class="col-md-2">
                                        <button type="submit" name="doctor_search_submit" class="btn btn-primary">
                                            Rechercher </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nom du Médecin</th>
                                    <th scope="col">Spécialisation</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Frais</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php 
                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;
                    $query = "select * from doctb";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                      $username = $row['username'];
                      $spec = $row['spec'];
                      $email = $row['email'];
                      $password = $row['password'];
                      $docFees = $row['docFees'];
                      
                      echo "<tr>
                        <td>$username</td>
                        <td>$spec</td>
                        <td>$email</td>
                        <td>$docFees</td>
                      </tr>";
                    }

                  ?>
                            </tbody>
                        </table>

                    </div>


                    <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">

                        <div class="col-md-8">
                            <form class="form-group" action="patientsearch.php" method="post">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="patient_contact"
                                            placeholder="Enter Contact" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="patient_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Identifiant du Patient</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom de Famille</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php 
                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;
                    $query = "select * from patreg";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                      $pid = $row['pid'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $gender = $row['gender'];
                      $email = $row['email'];
                      $contact = $row['contact'];
                      
                      echo "<tr>
                        <td>$pid</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$gender</td>
                        <td>$email</td>
                        <td>$contact</td>
                      </tr>";
                    }

                  ?>
                            </tbody>
                        </table>

                    </div>


                    <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">

                        <div class="col-md-8">

                            <div class="row">


                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th scope="col">Médecin</th>
                                                <th scope="col">Identifiant du Patient</th>
                                                <th scope="col">Identifiant du Rendez-vous</th>
                                                <th scope="col">Prénom</th>
                                                <th scope="col">Nom de Famille</th>
                                                <th scope="col">Date du Rendez-vous</th>
                                                <th scope="col">Heure du Rendez-vous</th>
                                                <th scope="col">Maladie</th>
                                                <th scope="col">Allergie</th>
                                                <th scope="col">Ordonnance</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php 
                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;
                    $query = "select * from prestb";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                      $doctor = $row['doctor'];
                      $pid = $row['pid'];
                      $ID = $row['ID'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $appdate = $row['appdate'];
                      $apptime = $row['apptime'];
                      $disease = $row['disease'];
                      $allergy = $row['allergy'];
                      $pres = $row['prescription'];

                      
                      echo "<tr>
                        <td>$doctor</td>
                        <td>$pid</td>
                        <td>$ID</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$appdate</td>
                        <td>$apptime</td>
                        <td>$disease</td>
                        <td>$allergy</td>
                        <td>$pres</td>
                      </tr>";
                    }

                  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">

                        <div class="col-md-8">
                            <form class="form-group" action="appsearch.php" method="post">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="app_contact"
                                            placeholder="Enter Contact" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="app_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Identifiant du Rendez-vous</th>
                                        <th scope="col">Identifiant du Patient</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Nom de Famille</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Nom du Médecin</th>
                                        <th scope="col">Frais de Consultation</th>
                                        <th scope="col">Date du Rendez-vous</th>
                                        <th scope="col">Heure du Rendez-vous</th>
                                        <th scope="col">Statut du Rendez-vous</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query = "select * from appointmenttb;";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                  ?>
                                    <tr>
                                        <td><?php echo $row['ID'];?></td>
                                        <td><?php echo $row['pid'];?></td>
                                        <td><?php echo $row['fname'];?></td>
                                        <td><?php echo $row['lname'];?></td>
                                        <td><?php echo $row['gender'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['contact'];?></td>
                                        <td><?php echo $row['doctor'];?></td>
                                        <td><?php echo $row['docFees'];?></td>
                                        <td><?php echo $row['appdate'];?></td>
                                        <td><?php echo $row['apptime'];?></td>
                                        <td>
                                            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                    {
                      echo "Active";
                    }
                    if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
                    {
                      echo "Cancelled by Patient";
                    }

                    if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
                    {
                      echo "Cancelled by Doctor";
                    }
                        ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        ...</div>

                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <form class="form-group" method="post" action="admin-panel1.php">
                            <div class="row">
                                <div class="col-md-4"><label>Doctor Name:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="doctor"
                                        onkeydown="return alphaOnly(event);" required></div>
                                <div class="col-md-4"><label>Specialization:</label></div>
                                <div class="col-md-8">
                                    <select name="special" class="form-control" id="special" required="required">
                                        <option value="head" name="spec" disabled selected>Select Specialization
                                        </option>
                                        <option value="General" name="spec">General</option>
                                        <option value="Cardiologist" name="spec">Cardiologist</option>
                                        <option value="Neurologist" name="spec">Neurologist</option>
                                        <option value="Pediatrician" name="spec">Pediatrician</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><label>Email ID:</label></div>
                                <div class="col-md-8"><input type="email" class="form-control" name="demail" required>
                                </div>
                                <div class="col-md-4"><label>Password:</label></div>
                                <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();'
                                        name="dpassword" id="dpassword" required></div>
                                <div class="col-md-4"><label>Confirm Password:</label></div>
                                <div class="col-md-8" id='cpass'><input type="password" class="form-control"
                                        onkeyup='check();' name="cdpassword" id="cdpassword" required>&nbsp &nbsp<span
                                        id='message'></span> </div>


                                <div class="col-md-4"><label>Consultancy Fees:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="docFees" required>
                                </div>
                            </div>
                            <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
                        </form>
                    </div>

                    <div class="tab-pane fade" id="list-settings1" role="tabpanel"
                        aria-labelledby="list-settings1-list">
                        <form class="form-group" method="post" action="admin-panel1.php">
                            <div class="row">

                                <div class="col-md-4"><label>Email ID:</label></div>
                                <div class="col-md-8"><input type="email" class="form-control" name="demail" required>
                                </div>

                            </div>
                            <input type="submit" name="docsub1" value="Delete Doctor" class="btn btn-primary"
                                onclick="confirm('do you really want to delete?')">
                        </form>
                    </div>


                    <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...
                    </div>

                    <div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">

                        <div class="col-md-8">
                            <form class="form-group" action="messearch.php" method="post">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="mes_contact"
                                            placeholder="Enter Contact" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="mes_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query = "select * from contact;";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
              
                      #$fname = $row['fname'];
                      #$lname = $row['lname'];
                      #$email = $row['email'];
                      #$contact = $row['contact'];
                  ?>
                                <tr>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['contact'];?></td>
                                    <td><?php echo $row['message'];?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>



                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
    <script>
    const check = function() {
        if (document.getElementById('dpassword').value ==
            document.getElementById('cdpassword').value) {
            document.getElementById('message').style.color = '#5dd05d';
            document.getElementById('message').innerHTML = 'Matched';
        } else {
            document.getElementById('message').style.color = '#f55252';
            document.getElementById('message').innerHTML = 'Not Matching';
        }
    }

    const alphaOnly(event) {
        var key = event.keyCode;
        return ((key >= 65 && key <= 90) || key == 8 || key == 32);
    };
    </script>


</body>

</html>