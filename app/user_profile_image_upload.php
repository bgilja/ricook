<?php
  include 'function_script.php';
  $target_dir = 'C:\xampp\htdocs\dashboard\ricook\app\src\uploads\profile_picture';
  $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
  $target_file = $target_dir . $_POST['id'] . "." . $imageFileType;
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
          $image_path = "src/uploads/profile_picture" . $id . "." . $imageFileType;

          $conn = connectToDatabase();
          $query = "UPDATE korisnik SET image = '$image_path' WHERE id = $id";
          $result = mysqli_query($conn, $query);
          closeDatabaseConnection($conn);
          header('Location:  user_profile.php?id=' . $id);
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
?>
