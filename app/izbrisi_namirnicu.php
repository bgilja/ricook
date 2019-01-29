<?php
  include 'function_script.php'
  $id = $_POST['id'];
  $namirnica = $_POST['id_namirnica'];
  $conn = connectToDatabase();

  $query = "DELETE FROM namirnica WHERE id = $namirnica";
  $result = mysqli_query($conn, $query);

  $query = "DELETE FROM korisnik_namirnica WHERE id_namirnica = $namirnica";
  $result = mysqli_query($conn, $query);

  $query = "DELETE FROM recept_namirnica WHERE id_namirnica = $namirnica";
  $result = mysqli_query($conn, $query);

  $sql = "DELETE FROM korisnik_namirnica WHERE id_korisnik = $id";
  $result = mysqli_query($conn, $sql);

  closeDatabaseConnection($conn);
  header( 'Location: add_ingredient.php?id=' . $id);
?>
