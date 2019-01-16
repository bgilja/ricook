<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Followers</title>
  </head>
  <body>

    <?php
      include 'function_script.php';
      $id = $_GET['id'];
      $row = getUserPersonalInfo($id);
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
          	<a class="nav-link active" href="user_friends.php?id=<?php echo $id; ?>">My Friends</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href="user_profile.php?id=<?php echo $id; ?>">Profile</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search" action="search.php?id=<?php echo $id; ?>" method="post">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="string" required>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h6 id="homepage_username"><?php echo getImage($row); ?></h6>
        <button type="button" class="btn btn-secondary" id="btn1" onclick="window.location.href='index.php'">Logout</button>
      </div>
    </nav>

    <div>
      <div class="nav2">
        <nav class="nav nav-pills nav-fill" role="tablist">
          <a class="nav-item nav-link border border-primary rounded-0 active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">All</a>
          <a class="nav-item nav-link border border-primary rounded-0" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Followers</a>
          <a class="nav-item nav-link border border-primary rounded-0" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Following</a>
        </nav>
      </div>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list"><?php printFollowersAndFollowing($id); ?></div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"><?php printFollowers($id); ?></div>
        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list"><?php printFollowing($id);?></div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
