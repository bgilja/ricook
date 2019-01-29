<?php
  include 'function_script.php';

  $ime = $_POST['dish_name'];
  $id = $_POST['id'];
  $upute = $_POST['instructions'];

  $image = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
  $conn = connectToDatabase();
  $sql = "INSERT INTO recept (ime, id_kreator, upute, ocjena, broj_pregleda) VALUES ('$ime', $id, '$upute', 0, 0)";
  $result = mysqli_query($conn, $sql);
  $sql = "SELECT MAX(id) AS brojac FROM recept WHERE id_kreator = $id";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_assoc();
  $id_picture = $row['brojac'];

  if ($image == "") header('Location:  fill_recipe.php?id='.$id.'&recipe='.$id_picture);

  $target_dir = 'C:\xampp\htdocs\dashboard\ricook\app\src\recipe\recipe_picture';
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
        $image_path = "src/recipe/recipe_picture" . $id_picture . "." . $imageFileType;
        $query = "UPDATE recept SET image = '$image_path' WHERE id = $id_picture";
        $result = mysqli_query($conn, $query);
    }
  }

  $breakfast = $_POST['breakfast'];
  $lunch = $_POST['lunch'];
  $dinner = $_POST['dinner'];
  $dessert = $_POST['dessert'];

  if ($breakfast) {
    $query = "INSERT INTO recept_obrok (id_recept, obrok) VALUES ($id_picture, 1)";
    $result = mysqli_query($conn, $query);
  }
  if ($lunch) {
    $query = "INSERT INTO recept_obrok (id_recept, obrok) VALUES ($id_picture, 2)";
    $result = mysqli_query($conn, $query);
  }
  if ($dinner) {
    $query = "INSERT INTO recept_obrok (id_recept, obrok) VALUES ($id_picture, 3)";
    $result = mysqli_query($conn, $query);
  }
  if ($dessert) {
    $query = "INSERT INTO recept_obrok (id_recept, obrok) VALUES ($id_picture, 4)";
    $result = mysqli_query($conn, $query);
  }

  closeDatabaseConnection($conn);
  header('Location:  fill_recipe.php?id='.$id.'&recipe='.$id_picture);
?>
