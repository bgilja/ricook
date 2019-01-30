<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $recipe = $_POST['recipe'];
  $conn = connectToDatabase();
  $sql = "INSERT INTO `favourite` (`id_korisnik`, `id_recept`) VALUES ($id, $recipe)";
  $result = mysqli_query($conn, $sql);
  closeDatabaseConnection($conn);

  header('Location: user_homepage.php?id=' . $id . '&recipe=' . $recipe);
?>
