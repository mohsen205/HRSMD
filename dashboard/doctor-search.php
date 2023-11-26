<!DOCTYPE html>
<html>

<head>
    <title>HRSMD | Détails du Médecin. </title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo.jpg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom-style/dashboard-home.css" />
</head>

<body>
    <?php
        include("../logic/dashboard.php");
            if(isset($_POST['doctor_search_submit']))
            {
                $contact=$_POST['doctor_contact'];
            $query = "select * from doctb where email= '$contact'";
            $result = mysqli_query($con,$query);
            $row=mysqli_fetch_array($result);
            if($row['username']=="" & $row['password']=="" & $row['email']=="" & $row['docFees']==""){
                echo "<script> alert('Aucune entrée trouvée !');
                    window.location.href = './dashboard/home.php#list-doc';</script>";
            }
            else {
                echo "<div class='container-fluid' style='margin-top:50px;'>
                <div class ='card'>
                <div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
            <table class='table table-hover'>
            <thead>
                <tr>
                <th scope='col'>Username</th>
                <th scope='col'>Email</th>
                <th scope='col'>Consultancy Fees</th>
                </tr>
            </thead>
            <tbody>";

		$username = $row['username'];
        $email = $row['email'];
        $docFees = $row['docFees'];
        echo "<tr>
          <td>$username</td>
          <td>$email</td>
          <td>$docFees</td>
        </tr>";
	echo "</tbody></table><center><a href='./home.php' class='btn btn-light'>Back to dashboard</a></div></center></div></div></div>";
}
  }

?>
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