<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Profile</title>
  </head>
  <body>

    <?php
      include 'database_connection.php';
      include 'followers.php';
      include 'user_information.php';
      $id = $_GET['id'];
      $conn = connectToDatabase();
      $row = getUserPersonalInfo($id, $conn);
      closeDatabaseConnection($conn);
    ?>

    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="user_homepage.php?id=<?php echo $id; ?>">Home</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href="user_friends.php?id=<?php echo $id; ?>">My Friends</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link active" href="user_profile.php?id=<?php echo $id; ?>">Profile</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search"  >
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h6 id="homepage_username"><?php echo $row['user_name'] ?></h6>
        <button type="button" class="btn btn-secondary" id="btn1" onclick="window.location.href='index.php'">Logout</button>
      </div>
    </nav>

    <div class="user_information_block">
      <div class="user_block" id="user_block1">
        <img class="rounded float-left" src="<?php echo getImage($row) ?>" id="avatar">
        <div class="profile_buttons">
          <button type="button" class="btn btn-primary" id="change_pass_btn" onclick="">Change password</button>
          <button type="button" class="btn btn-danger" id="change_profile_image_btn" onclick="">Change picture</button>
        </div>
      </div>
      <div class="user_block">
        <span>
          <ul class="list-group" id="user_info_list_left">
            <li class="list-group-item">Username: <span class="info_text"><?php echo $row['user_name'] ?></span></li>
            <li class="list-group-item">First name: <span class="info_text"><?php echo $row['first_name'] ?></span></li>
            <li class="list-group-item">Last name: <span class="info_text"><?php echo $row['last_name'] ?></span></li>
            <li class="list-group-item">Email: <span class="info_text"><?php echo $row['email'] ?></span></li>
            <li class="list-group-item">Year of birth: <span class="info_text"><?php echo $row['year_of_birth'] ?></span></li>
            <li class="list-group-item"><a>Last active: <span class="info_text"><?php echo "0" ?></span></li>
          </ul>
        </span>
        <span>
          <ul class="list-group">
            <li class="list-group-item">Recipes: <span class="info_text"><?php echo "0" ?></span></li>
            <li class="list-group-item">Average rating: <span class="info_text"><?php echo "0" ?></span></li>
            <li class="list-group-item">Highest rating recipe: <span class="info_text"><?php echo "0" ?></span></li>
            <li class="list-group-item">Lowest rating recipe: <span class="info_text"><?php echo "0" ?></span></li>
            <li class="list-group-item">Followers: <span class="info_text"><?php echo "0" ?></span></li>
            <li class="list-group-item">Following: <span class="info_text"><?php echo "0" ?></span></li>
          </ul>
        </span>
      </div>
      <div class="jumbotron" id="user_jumbotron">
        <h1 class="display-4">Hello, chef!</h1>
        <p class="lead">Cooking is not difficult. Everyone has taste, even if they don't realize it. Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.</p>
        <hr class="my-4">
        <input type="button" class="btn btn-secondary" name="change_status_button" value="Change status">
      </div>
    </div>


    <div class="container">
      <div class="modal fade" id="change_pass_modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Change password</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <form role="form" action="user_password_cnahge.php" method="post">
                <div class="form-group">
                  <label for="usrname">Password</label>
                  <input type="password" class="form-control" id="usrname" placeholder="Enter password" name="pass1">
                </div>
                <div class="form-group">
                  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> New password</label>
                  <input type="password" class="form-control" id="psw" placeholder="Enter new password" name="pass2">
                </div>
                <div class="form-group">
                  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> New password</label>
                  <input type="password" class="form-control" id="psw" placeholder="Enter new password one more time" name="pass3">
                </div>
                  <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Login</button>
              </form>
            </div>
            <div class="modal-footer">
              <p>Forgot <a href="">Password?</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="modal fade" id="change_profile_image_modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Change profile picture</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <form action="user_profile_image_upload.php" method="post" enctype="multipart/form-data">
                <h3>Select image to upload:</h3>
                <input type="file" name="fileToUpload" id="image_preview_file">
                <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="popup_change_password_modal.js"></script>
    <script src="popup_change_profile_image_modal.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
