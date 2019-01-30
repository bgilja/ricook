<?php
  session_start();
  include 'function_script.php';

  $user_name = $_POST['username'];
  $password = $_POST['pass'];

  $sql = "SELECT id, COUNT(*) AS brojac FROM korisnik WHERE user_name = '".$user_name."' AND password = '".$password."'";
  $row = returnSQLResult($sql);
  if ($row['brojac'] > 0) {
    $_SESSION['user_id'] = $row[id];
    header('Location:  user_homepage.php?id='.$row['id']);
  } else {
    header('Location:  index.php');
  }
?>
