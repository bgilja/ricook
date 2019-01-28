<?php
  include 'function_script.php';
  
  $id = $_POST['id'];
  $ime = $_POST['ime'];
  $protein = $_POST['protein'];
  $ugljikohidrati = $_POST['ugljikohidrati'];
  $masti = $_POST['masti'];
  $kcal = calculateIngredientCalories($protein, $ugljikohidrati, $masti);

  $conn = connectToDatabase();
  $query = "INSERT INTO `namirnica`(`ime`, `protein`, `ugljikohidrati`, `masti`, `kcal`) VALUES ('" . $ime . "', '" . $protein . "', '" . $ugljikohidrati . "', '" . $masti . "','" . $kcal . "')";
  $result = mysqli_query($conn, $query);
  closeDatabaseConnection($conn);
  header( 'Location: add_ingredient.php?id='.$id);
?>
