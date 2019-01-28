<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $kolicina = round($_POST['kolicina']);
  $namirnica = $_POST['namirnica'];
  $recept = $_POST['recept'];

  $conn = connectToDatabase();
  $query = "INSERT INTO recept_namirnica (id_recept, id_namirnica, kolicina) VALUES ($recept, $namirnica, $kolicina)";
  $result = mysqli_query($conn, $query);
  closeDatabaseConnection($conn);
  header( 'Location: fill_recipe.php?id='.$id.'&recipe='.$recept.'');
?>
