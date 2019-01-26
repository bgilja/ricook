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
      include 'function_script.php';
      $id = $_GET['id'];
      $user = $_GET['user'];
      $conn = connectToDatabase();
      $row = getUserPersonalInfo($user, $conn);
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
          	<a class="nav-link" href="user_profile.php?id=<?php echo $id; ?>">Profile</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search" action="search.php?id=<?php echo $id; ?>" method="post">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="string" required>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h6 id="homepage_username"><?php echo $id ?></h6>
        <button type="button" class="btn btn-secondary" id="btn1" onclick="window.location.href='index.php'">Logout</button>
      </div>
    </nav>

    <div class="user_profile_page h-100 w-100">
      <div class="row w-100 h-100">
        <div class="col-4 p-1" style="background-color: grey">
          <div class="user_information_block">
            <div class="user_block" id="user_block1">
              <img class="rounded float-left mw-75 mh-75" src="<?php echo getImage($row) ?>" id="avatar">
              <div class="profile_buttons">
                <button type="button" class="btn btn-primary" id="change_pass_btn" onclick="">Change password</button>
                <button type="button" class="btn btn-danger" id="change_profile_image_btn" onclick="">Change picture</button>
                <button type="button" class="btn btn-warning" id="delete_profile_image_btn" onclick="">Delete picture</button>
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
                  <li class="list-group-item">Followers: <span class="info_text"><?php echo sumFollowers($user); ?></span></li>
                  <li class="list-group-item">Following: <span class="info_text"><?php echo sumFollowing($user); ?></span></li>
                </ul>
              </span>
            </div>
            <div class="jumbotron" id="user_jumbotron">
              <h1 class="display-4">Hello, chef!</h1>
              <p class="lead">Cooking is not difficult. Everyone has taste, even if they don't realize it.
                Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.
                <br>Cooking is not difficult. Everyone has taste, even if they don't realize it.
                  Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.</p>
              <hr class="my-4">
              <button type="button" class="btn btn-secondary" id="change_status_button" onclick="">Change status</button>
            </div>
          </div>
        </div>
        <div class="col-8 float-left">
          <div class="mt-2">
            <?php for ($i=0; $i < 100; $i++) printAllUserRecepies($id, $user);
            ?>
          </div>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
