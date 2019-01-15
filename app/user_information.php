<?php
  function getUserPersonalInfo($id, $conn) {
    $sql = "SELECT * FROM korisnik WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function getImage($row) {
    if (substr($row['image'], 0, 3) === "src") return $row['image'];
    return "src/default_avatar.jpg";
  }
?>
