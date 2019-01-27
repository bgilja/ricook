<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $user = $_POST['user'];
  $conn = connectToDatabase();
  stopFollowing($id, $user);
  closeDatabaseConnection($conn);

  header('Location: user_homepage.php?id=' . $id);
?>
