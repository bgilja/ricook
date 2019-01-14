<?php

  $old_pass = $_POST['pass1'];
  $pass1 = $_POST['pass2'];
  $pass2 = $_POST['pass3'];
  $id = $_POST['id'];

  if (isset($pass1) && isset($pass2)) {
    if ($pass1 != $pass2) {
      header('Location:  user_profile.php?id=' . $id);
    }
  }

  $servername = "127.0.0.1";
  $username = "student";
  $password = "student";
  $dbname = "ricook";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
  }

  $query = "UPDATE korisnik SET password = $pass1 WHERE id = $id";
  $result = mysqli_query($conn, $query);
  mysqli_close($conn);
  header('Location:  user_profile.php?id=' . $id);
?>
