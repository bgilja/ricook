<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $check = $_POST['check'];

  $conn = connectToDatabase();
  $sql = "UPDATE korisnik SET image = 'src/default_avatar.jpg' WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);

  header('Location:  user_profile.php?id='.$id);
?>
