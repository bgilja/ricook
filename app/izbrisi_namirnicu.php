<?php
  include 'function_script.php'
  $id = $_POST['id'];
  $namirnica = $_POST['id_namirnica'];
  deleteIngredient($namirnica);
  header( 'Location: add_ingredient.php?id=' . $id);
?>
