<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $user = $_POST['user'];
  $conn = connectToDatabase();
  startFollowing($id, $user);
  closeDatabaseConnection($conn);

  header('Location: user_friends.php.?id=' . $id);
?>