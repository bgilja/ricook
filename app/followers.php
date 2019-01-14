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

  function printFollowers($id, $conn) {
    $sql1 = "SELECT id_pratioc FROM pratitelj WHERE id_pratitelj = $id";
    $result1 = mysqli_query($conn, $sql1);

    while($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratioc]";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();
      echo $row2['first_name'] . $row2['last_name'] . "<br>";
    }
  }

  function printFollowing($id, $conn) {
    $sql1 = "SELECT id_pratitelj FROM pratitelj WHERE id_pratioc = $id";
    $result1 = mysqli_query($conn, $sql1);

    while($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratitelj]";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();
      echo $row2['first_name'] . $row2['last_name'] . "<br>";
    }
  }

  /*<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <?php
    include 'followers.php';
    $conn = connectToDatabase();
    printFollowers($_GET['id'], $conn);
    printFollowing($_GET['id'], $conn);
    closeDatabaseConnection($conn);
    ?>
  </div>
  <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <?php
    include 'followers.php';
    $conn = connectToDatabase();
    printFollowers($_GET['id'], $conn);
    closeDatabaseConnection($conn);
    ?>
  </div>
  <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <?php
    include 'followers.php';
    $conn = connectToDatabase();
    printFollowing($_GET['id'], $conn);
    closeDatabaseConnection($conn);
    ?>
  </div>*/
?>
