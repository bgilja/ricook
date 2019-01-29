<?php
  include 'function_script.php';

  $komentar = $_POST['comment'];
  $id = $_POST['id'];
  $recept = $_POST['recipe'];
  $time = 1;

  $conn = connectToDatabase();

  $sql = "INSERT INTO komentar (id_kreator, tekst, vrijeme, id_recept) VALUES ($id, '$komentar', $time, $recept)";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);
  header("location: see_recipe.php?id=" .$id . "&recipe=". $recept);


 ?>
