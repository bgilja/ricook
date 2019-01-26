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
      $id = 1;
      $recipe = 18;
      $conn = connectToDatabase();
      $row = getRecipeInfo($recipe, $conn);
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
          <div class="col-4 p-1 pl-4 pr-3 h-100" style="background-color: grey;">
          <div class="user_information_block">
            <div class="user_block" id="user_block1">
              <img class="rounded float-left mw-75 mh-75" src=" <?php echo $row['image'] ?>">
              <div class="profile_buttons">
                <button type="button" class="btn btn-primary" id="recipe_fav_btn" onclick="">Favourite</button>
                <button type="button" class="btn btn-info" id="delete_profile_image_btn" onclick="">Give rating</button>
              </div>
            </div>
            <div class="user_block">
                <ul class="list-group w-100">
                  <li class="list-group-item">Created by: <span class="info_text"><?php echo $row['id_kreator']; ?></span></li>
                  <li class="list-group-item">Rated by: <span class="info_text"><?php echo $row['broj_ocjena']; ?></span></li>
                  <li class="list-group-item">Rating: <span class="info_text"><?php echo $row['ocjena']; ?></span></li>
                  <li class="list-group-item">Favourited by: <span class="info_text"><?php $row['image']; ?></span></li>
                </ul>
            </div>
            <div class="table" style="height: 500px;">
              <table id="tablica" class="table table-sm">
                <thead><tr ><th class="table-success" scope="col">Nutritivne vrijednosti:</th><th class="table-success"></th></tr></thead>
                <tbody>
                  <tr class="table-success"><td>Bjelancevine:</td><td>50g</td></tr>
                  <tr class="table-success"><td>Ugljikohidrati:</td><td>100g</td></tr>
                  <tr class="table-success"><td >Masti:</td><td>30g</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-8 float-left">
          <div class="mt-2">
            <div class="jumbotron" id="user_jumbotron">
              <h1 class="display-4">Upute</h1>
              <p class="lead">Cooking is not difficult. Everyone has taste, even if they don't realize it.
                Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.
                <br>Cooking is not difficult. Everyone has taste, even if they don't realize it.
                  Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.</p>
              <hr class="my-4">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="modal fade" id="delete_profile_image_modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Rate recipe</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <form role="form" action="recipe_rating.php" method="post">
                <div class="form-group">
                  <label>Recipe rating is from 1 to 10</label>
                  <input type="number" name="rating" required min="1" max="10" style="margin-left: 10px;">
                </div>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="recipe" value="<?php echo $recipe; ?>">
                  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Rate</button>
              </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="popup_delete_profile_image_modal.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
