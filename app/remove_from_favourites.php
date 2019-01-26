<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $recipe = $_POST['recipe'];
  $conn = connectToDatabase();
  $sql = "DELETE FROM `favourite` WHERE id_korisnik = $id AND id_recept = $recipe";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);

  header('Location: see_recipe.php?id=' . $id . '&recipe=' . $recipe);
?>
