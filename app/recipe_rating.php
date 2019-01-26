<?php

  include 'function_script.php';

  $id = $_POST['id'];
  $recept = $_POST['recipe'];
  $rating = $_POST['rating'];

  $conn = connectToDatabase();
  $row = getRecipeInfo($recept);

  $suma_ocjena = $row['suma_ocjena']+$rating;
  $broj_ocjena = $row['broj_ocjena']+1;
  $ocjena = $suma_ocjena / $broj_ocjena;

  $query = "UPDATE recept SET suma_ocjena = $suma_ocjena, broj_ocjena = $broj_ocjena, ocjena = $ocjena WHERE id = $recept";
  $result = mysqli_query($conn, $query);

  closeDatabaseConnection($conn);
  header('Location:  see_recipe.php.?id=' . $id . '&recipe=' . $recept);
?>
