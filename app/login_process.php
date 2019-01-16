<?php

  include 'function_script.php';

  $user_name = $_POST['login_username'];
  $password = $_POST['login_password'];
  $id = -1;

  $conn = connectToDatabase();

  $sql = "SELECT id, user_name, email FROM korisnik";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  $flag = false;
  while($row = $result->fetch_assoc()) {
    if ($row["user_name"] == $user_name || $row["password"] == $password) {
      $id = $row["id"];
      $flag = true;
    }
  }

  closeDatabaseConnection($conn);
  if ($flag) {
    header('Location:  user_homepage.php.?id='.$id);
  } else {
    header('Location:  index.php');
  }
?>
