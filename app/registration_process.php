<?php

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $user_name = $_POST['username'];
  $email = $_POST['email'];
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];
  $year = $_POST['year'];

  if (isset($pass1) && isset($pass2)) {
    if ($pass1 != $pass2) {
      header('Location:  register.php');
    }
  }

  $servername = "127.0.0.1";
  $username = "student";
  $password = "student";
  $dbname = "ricook";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
  }

  $sql = "SELECT user_name, email FROM korisnik";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  $flag = false;
  while($row = $result->fetch_assoc()) {
    if ($row["user_name"] == $user_name || $row["email"] == $email) {
      $flag = true;
    }
  }

  if ($flag == false) {
    if (isset($first_name) && isset($last_name) && isset($user_name) && isset($email) && isset($pass1) && isset($year)) {
      $sql_query = $conn->prepare("INSERT INTO korisnik (first_name, last_name, user_name, email, year_of_birth, password) VALUES (?, ?, ?, ?, ?, ?)");
      $sql_query->bind_param('ssssis', $first_name, $last_name, $user_name, $email, $year, $pass1);
      $sql_query->execute();
      $result = $sql_query->get_result();
      $stmt->close();
      header('Location:  index.php');
    } else {
      header('Location:  register.php');
    }
  }
?>
