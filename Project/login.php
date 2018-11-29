<?php
include 'connection.php';

session_start();

$error = 1;

if(isset($_SESSION['username'])){
    header("Location: produse.php");
}

if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $parola=$_POST['parola'];

    $query = mysqli_query($db,"SELECT id FROM user WHERE username='$username' AND parola='$parola'");

    if(mysqli_num_rows($query)){
        $error = 0;
        $_SESSION['username'] = $username;
        while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
            $_SESSION['id'] = $row['id'];
        }
        header("Location: produse.php");
    }else{

    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login page</title>
  <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>
   <div class="container">
      <div class="col-6 offset-3 text-center">

          <?php
          if(isset($_POST['submit']) && $error == 1){
               echo "<h1 class='badge badge-danger'>User sau parola incorecte</h1>";
          }
          ?>

          <form action="login.php" method="POST">
          Username:<input type="text" name="username" class="form-control">
          <br>
          Parola:<input type="password" name="parola" class="form-control">
          <br>
          <input type="submit" name="submit" value="Autentificare" class="btn btn-info">
          </form>      
     </div>
   </div>

</body>
</html>








