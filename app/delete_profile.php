<?php
  include 'function_script.php';
  $id = $_POST['id'];
  $conn = connectToDatabase();
  $sql = "DELETE FROM korisnik WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  $sql = "DELETE FROM recept WHERE id_kreator = $id";
  $result = mysqli_query($conn, $sql);

  $sql = "DELETE FROM pratitelj WHERE id_pratitelj = $id OR id_pratioc = $id";
  $result = mysqli_query($conn, $sql);

  $sql = "DELETE FROM favourite WHERE id_korisnik = $id";
  $result = mysqli_query($conn, $sql);

  closeDatabaseConnection($conn);
  header('Location:  index.php');
?>
