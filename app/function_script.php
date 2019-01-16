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

  function getImage($row) {
    if (substr($row['image'], 0, 3) === "src") return $row['image'];
    return "src/default_avatar.jpg";
  }

  function getUserPersonalInfo($id) {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM korisnik WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row;
  }

  function isFollowing($id1, $id2) {
    return true;
  }

  function getRecipeNumber($id) {
    /*$conn = connectToDatabase();
    $sql = "SELECT COUNT(*) as count FROM recept WHERE id_vlasnik = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['count'];*/
  }

  function getAverageRecipeRating($id) {
    /*$conn = connectToDatabase();
    $sql = "SELECT COUNT(*) as count, SUM(rating) as suma FROM recept WHERE id_vlasnik = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['suma'] / $row['count'];*/
  }

  function getHighestRecipeRating($id) {
    /*$conn = connectToDatabase();
    $sql = "SELECT MAX(rating) FROM recept WHERE id_vlasnik = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['rating'];*/
  }

  function getLowestRecipeRating($id) {
    /*$conn = connectToDatabase();
    $sql = "SELECT MIN(rating) FROM recept WHERE id_vlasnik = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['rating'];*/
  }

  function sumFollowers($id) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) as count FROM pratitelj WHERE id_pratitelj = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['count'];
  }

  function sumFollowing($id) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) as count FROM pratitelj WHERE id_pratioc = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['count'];
  }

  function printTablestart() {
    echo ' <br><div> ';
  }

  function printEndDiv() {
    echo ' </div><br> ';
  }

  function printPersonRow() {
    echo ' <div class="person_row mx-75"> ';
  }

  function printPersonCard($id, $map) {
    echo ' <div class="card w-25 p-1 float-left border border-light shadow rounded-0">
            <span>
              <img src="' . getImage($map) . '" class="card-img-top w-50 border border-light float-left">
              <a href="other_profile.php?id=' . $id .'&user=' . $map["id"] .'" value="Unfollow" class="btn btn-primary align-top w-50 mb-1">Visit profile</a> ';
    if (isFollowing($id, $map['id'])) {
      echo ' <input type="submit" name="submit" value="Unfollow" class="btn btn-primary align-top w-50 mb-1" id="user_unfollow_btn"> ';
    } else {
      echo ' <input type="button" name="submit3" value="Follow" class="btn btn-primary align-top w-50 mb-1" id="user_follow_btn"> ';
    }
    echo '   </span>
          </div> ';
  }

  function queryPersonCard($result1, $conn, $id) {
    $brojac = 0;
    printTablestart();
    printPersonRow();
    while($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT * FROM korisnik WHERE id = " . $row1['id'];
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();
      $brojac += 1;
      printPersonCard($id, $row2);
      if ($brojac % 4 == 0) {
        printEndDiv();
        printPersonRow();
      }
    }
    printEndDiv();
    printEndDiv();
  }

  function printFollowersAndFollowing($id) {
    $conn = connectToDatabase();
    $sql1 = "SELECT id_pratioc AS id FROM pratitelj WHERE id_pratitelj = $id
            UNION
            SELECT id_pratitelj AS id FROM pratitelj WHERE id_pratioc = $id";
    $result1 = mysqli_query($conn, $sql1);
    queryPersonCard($result1, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function printFollowers($id) {
    $conn = connectToDatabase();
    $sql1 = "SELECT id_pratioc AS id FROM pratitelj WHERE id_pratitelj = $id";
    $result1 = mysqli_query($conn, $sql1);
    queryPersonCard($result1, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function printFollowing($id) {
    $conn = connectToDatabase();
    $sql1 = "SELECT id_pratitelj AS id FROM pratitelj WHERE id_pratioc = $id";
    $result1 = mysqli_query($conn, $sql1);
    queryPersonCard($result1, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function showUser($name) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM korisnik WHERE id in (SELECT id FROM korisnik WHERE first_name LIKE ('%$name%') OR last_name LIKE ('%$name%') OR user_name LIKE ('%$name%'))";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }

  function showRecipe($name) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM korisnik";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }

  function showIngredient($name) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM korisnik";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }

  function showTag($name) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM korisnik";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }
?>