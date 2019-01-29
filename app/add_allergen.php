<?php
  include 'function_script.php';

  $namirnica = $_POST['namirnica'];
  $id = $_POST['id'];

  $conn = connectToDatabase();

  $sql = "INSERT INTO korisnik_namirnica (id_korisnik, id_namirnica) VALUES ($id, $namirnica)";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);
  header("location: user_profile.php?id=" .$id);


 ?>
