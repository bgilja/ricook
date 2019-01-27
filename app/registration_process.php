<?php
  include 'function_script.php';
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $user_name = $_POST['username'];
  $email = $_POST['email'];
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];
  $year = $_POST['year'];
  $image = "src/default_avatar.jpg";

  if ($pass1 != $pass2) {
    header('Location:  register.php');
  }

  $conn = connectToDatabase();
  $sql = "SELECT COUNT(*) AS brojac FROM korisnik WHERE user_name = $user_name OR email = $email";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_assoc();

  if ($row['brojac'] > 0) {
    closeDatabaseConnection($conn);
    header('Location:  register.php');
  } else {
    $sql = "INSERT INTO korisnik (first_name, last_name, user_name, email, year_of_birth, password, image) VALUES ('$first_name', '$last_name', '$user_name', '$email', $year, '$pass1', '$image')";
    $result = mysqli_query($conn, $sql);
    closeDatabaseConnection($conn);
    header('Location:  index.php');
  }
?>
