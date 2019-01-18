<?php
  include 'function_script.php';

  $ime = $_POST['dish_name'];
  $id = $_POST['id'];
  $image = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));

  $conn = connectToDatabase();

  $sql = "INSERT INTO recept (ime, id_kreator, suma_ocjena, broj_ocjena, upute, ocjena) VALUES ('$ime', $id, 0, 0, 'zz', 0)";
  $result = mysqli_query($conn, $sql);

  $sql = "SELECT MAX(id) AS a FROM recept WHERE id_kreator = $id";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_assoc();
  $id_picture = $row['a'];

  if ($image == "") header('Location:  user_homepage.php.?id='.$id);

  $target_dir = 'C:\xampp\htdocs\dashboard\ricook\app\src\recipe\recipe_picture';
  $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
  $target_file = $target_dir . $id_picture . "." . $imageFileType;
  $uploadOk = 1;
  // Check if image file is a actual image or fake image
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
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $id = $_POST['id'];
          $image_path = "src/recipe/recipe_picture" . $id_picture . "." . $imageFileType;

          $query = "UPDATE recept SET image = '$image_path' WHERE id = $id_picture";
          $result = mysqli_query($conn, $query);
          header('Location:  user_homepage.php?id=' . $id);
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }

  closeDatabaseConnection($conn);
  header('Location:  user_homepage.php.?id='.$id);
?>
