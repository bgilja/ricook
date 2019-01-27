<?php
  include 'function_script.php';
  $id = $_POST['id'];
  $recipe = $_POST['recipe'];
  $conn = connectToDatabase();
  $sql = "DELETE FROM recept WHERE id = $recipe";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);
  header('Location:  user_homepage.php?id=' . $id);
?>
