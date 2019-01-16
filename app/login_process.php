<?php


  $user_name = $_POST['login_username'];
  $password = $_POST['password'];
  $id = -1;

  $servername = "127.0.0.1";
  $username = "student";
  $password = "student";
  $dbname = "ricook";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
  }

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

  if ($flag) {
    header('Location:  user_homepage.php.?oib='.$id);
  } else {
    header('Location:  index.php');
  }
?>
