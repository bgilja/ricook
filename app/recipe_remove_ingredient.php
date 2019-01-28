<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $namirnica = $_POST['namirnica'];
  $recept = $_POST['recept'];

  $conn = connectToDatabase();
  $query = "DELETE FROM recept_namirnica WHERE id_recept = $recept AND id_namirnica = $namirnica";
  $result = mysqli_query($conn, $query);
  closeDatabaseConnection($conn);
  header( 'Location: fill_recipe.php?id='.$id.'&recipe='.$recept.'');
?>
