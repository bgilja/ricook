<?php
  include 'function_script.php';
  $id = $_POST['id'];
  deleteProfile($id);
  header('Location:  index.php');
?>
