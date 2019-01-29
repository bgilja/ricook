<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $recipe = $_POST['recipe'];
  $conn = connectToDatabase();

  $sql = "DELETE FROM recept WHERE id = $recipe";
  $result = mysqli_query($conn, $sql);

  $sql = "DELETE FROM favourite WHERE id_recept = $recipe";
  $result = mysqli_query($conn, $sql);

  $sql = "DELETE FROM komentar WHERE id_recept = $recipe";
  $result = mysqli_query($conn, $sql);

  $sql = "DELETE FROM recept_namirnica WHERE id_recept = $recipe";
  $result = mysqli_query($conn, $sql);

  $sql = "DELETE FROM recept_obrok WHERE id_recept = $recipe";
  $result = mysqli_query($conn, $sql);

  closeDatabaseConnection($conn);
  header('Location:  user_homepage.php?id=' . $id);
?>
