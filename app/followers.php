<?php
  function printTablestart() {
    echo ' <div class="person_follow_table h-100 p-3"> ';
  }

  function printEndDiv() {
    echo ' </div> ';
  }

  function printPersonRow() {
    echo ' <div class="person_row mx-auto"> ';
  }

  function printPersonCard($map) {
    echo ' <div class="card w-25 p-3 float-left">
          <span>
            <img src="src/default_avatar.jpg" class="card-img-top w-50 p-3 border border-dark float-left" alt="...">
            <input type="button" name="submit" value="Submit" class="btn btn-primary align-top" id="user_block_btn">
          </span>
          <div class="card-body">
            <h3 class="card-text">' . $map['first_name'] . " " . $map['last_name'] .'</h3>
          </div>
        </div> ';
  }

  /*function followerQuery($id, $conn) {
    $sql1 = "SELECT id_pratioc FROM pratitelj WHERE id_pratitelj = $id";
    $result1 = mysqli_query($conn, $sql1);
    return $result1;
  }

  function followingQuery($id, $conn) {
    $sql1 = "SELECT id_pratitelj FROM pratitelj WHERE id_pratioc = $id";
    $result1 = mysqli_query($conn, $sql1);
    return $result1;
  }*/

  function printFollowers($id, $conn) {
    $sql1 = "SELECT id_pratioc FROM pratitelj WHERE id_pratitelj = $id";
    $result1 = mysqli_query($conn, $sql1);

    while($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratioc]";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();

      printPersonCard($row2);
    }
  }

  function printFollowing($id, $conn) {
    $sql1 = "SELECT id_pratitelj FROM pratitelj WHERE id_pratioc = $id";
    $result1 = mysqli_query($conn, $sql1);

    while($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratitelj]";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();

      printPersonCard($row2);
    }
  }
?>
