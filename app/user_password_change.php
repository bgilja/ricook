<?php
  include 'function_script.php';
  
  $old_pass = $_POST['pass1'];
  $pass1 = $_POST['pass2'];
  $pass2 = $_POST['pass3'];
  $id = $_POST['id'];

  if (isset($pass1) && isset($pass2)) {
    if ($pass1 != $pass2) {
      header('Location:  user_profile.php?id=' . $id);
    }
  }

  $conn = connectToDatabase();
  $query = "UPDATE korisnik SET password = $pass1 WHERE id = $id";
  $result = mysqli_query($conn, $query);
  closeDatabaseConnection($conn);
  header('Location:  user_profile.php?id=' . $id);
?>
