<?php

  include 'function_script.php';

  $id = $_POST['id'];
  $recept = $_POST['recipe'];
  $rating = $_POST['rating'];

  $conn = connectToDatabase();
  if (getUserRatingForRecipe($id, $recept) > 0) {
    $query = "UPDATE rejting SET ocjena = $rating WHERE id_recept = $recept AND id_korisnik = $id";
  } else {
    $query = "INSERT INTO rejting (id_recept, id_korisnik, ocjena) VALUES ($recept, $id, $rating)";
  }
  $result = mysqli_query($conn, $query);

  $query = "SELECT SUM(ocjena) AS a, COUNT(ocjena) AS b FROM rejting WHERE id_recept = $recept";
  $result = mysqli_query($conn, $query);
  $row = $result->fetch_assoc();
  if ($row['b'] == 0) $nova_ocjena = $row['a'];
  else $nova_ocjena = $row['a']/$row['b'];
  $query = "UPDATE recept SET ocjena = $nova_ocjena WHERE id = $recept";
  $result = mysqli_query($conn, $query);

  closeDatabaseConnection($conn);
  header('Location:  see_recipe.php.?id=' . $id . '&recipe=' . $recept);
?>
