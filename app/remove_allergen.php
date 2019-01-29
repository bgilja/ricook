<?php
  include 'function_script.php';

  $namirnica = $_POST['namirnica'];
  $id = $_POST['id'];

  $conn = connectToDatabase();

  $sql = "DELETE FROM korisnik_namirnica WHERE id_korisnik = $id AND id_namirnica = $namirnica";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);
  header("location: user_profile.php?id=" .$id);


 ?>
