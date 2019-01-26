<?php
  include 'function_script.php';
  $id = $_POST['id'];
  $conn = connectToDatabase();
  $sql = "DELETE FROM korisnik WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);
  header('Location:  index.php');
?>
