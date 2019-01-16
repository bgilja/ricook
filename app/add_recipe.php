<?php
  include 'function_script.php';

  $ime = $_POST['dish_name'];
  $id = $_POST['id'];

  $conn = connectToDatabase();

  $sql = "INSERT INTO recept (ime, id_kreator, suma_ocjena, broj_ocjena, upute, ocjena) VALUES ('$ime', $id, 0, 0, 'zz', 0)";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  closeDatabaseConnection($conn);
  header('Location:  user_homepage.php.?id='.$id);
?>
