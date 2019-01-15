<?php
  function connectToDatabase() {
    $servername = "127.0.0.1";
    $username = "student";
    $password = "student";
    $dbname = "ricook";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
    }

    return $conn;
  }

  function closeDatabaseConnection($conn) {
    mysqli_close($conn);
  }
?>
