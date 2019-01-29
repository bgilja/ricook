<?php
  include 'function_script.php';
  $id = $_POST['id'];
  $recipe = $_POST['recipe'];
  deleteRecipe($recipe);
  header('Location:  user_homepage.php?id=' . $id);
?>
