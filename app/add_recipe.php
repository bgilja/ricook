<?php
  include 'function_script.php';

  $ime = $_POST['dish_name'];
  $upute = $_POST['instructions'];
  $id = $_POST['id'];

  /*$conn = connectToDatabase();

  $sql = "INSERT INTO recept (ime , upute) VALUES ('$ime', '$upute')";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  closeDatabaseConnection($conn);*/
  header('Location:  user_homepage.php.?id='.$id);
?>
