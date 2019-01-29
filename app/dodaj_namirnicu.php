<?php
  include 'function_script.php';

  $id = $_POST['id'];
  $ime = $_POST['ime'];
  $protein = $_POST['protein'];
  $ugljikohidrati = $_POST['ugljikohidrati'];
  $masti = $_POST['masti'];
  $kcal = calculateIngredientCalories($protein, $ugljikohidrati, $masti);

  $image = "src/ingredient_default.jpg";
  $conn = connectToDatabase();
  $query = "INSERT INTO namirnica(ime, protein, ugljikohidrati, masti, kcal, image) VALUES ('$ime', $protein, $ugljikohidrati, $masti, $kcal, '$image')";
  $result = mysqli_query($conn, $query);

  $sql = "SELECT MAX(id) AS brojac FROM namirnica;";
  $id_picture = returnSQLResult($sql)['brojac'];

  $image = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
  if ($image == "")   header( 'Location: add_ingredient.php?id='.$id);

  $target_dir = 'C:\xampp\htdocs\dashboard\ricook\app\src\ingredient\ingredient_picture';
  $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
  $target_file = $target_dir . $id_picture . "." . $imageFileType;
  $uploadOk = 1;

  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }

  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }

  if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $image_path = "src/ingredient/ingredient_picture" . $id_picture . "." . $imageFileType;
        $query = "UPDATE namirnica SET image = '$image_path' WHERE id = $id_picture";
        $result = mysqli_query($conn, $query);
    }
  }


  closeDatabaseConnection($conn);
  header( 'Location: add_ingredient.php?id='.$id);
?>
