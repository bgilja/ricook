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
          <?php
          if ($id == 1) {
            echo '<li class="nav-item">
                    <a class="nav-link" href="add_ingredient.php?id=' .$id . '">Add ingredient</a>
                  </li>';
          }
          ?>
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
        <div class="col-4 p-1 pl-4 pr-3" style="background-color: grey">
          <div class="user_information_block">
            <div class="user_block" id="user_block1">
              <img class="rounded float-left mw-75 mh-75" src="<?php echo getImage($row) ?>" id="avatar">
              <div class="profile_buttons">
                <button type="button" class="btn btn-primary" id="change_pass_btn" onclick="">Change password</button>
                <button type="button" class="btn btn-success" id="change_profile_image_btn" onclick="">Change picture</button>
                <button type="button" class="btn btn-info" id="delete_profile_image_btn" onclick="">Delete picture</button>
                <form class="" action="delete_profile.php" method="post" id="delete_profile">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                </form>
                <button type="submit" class="btn btn-danger" form="delete_profile" id="delete_profile_image_btn" onclick="">Delete profile</button>
                <button type="submit" class="btn btn-danger" id="allergens" onclick="">My allergens</button>
              </div>
            </div>
            <div class="user_block w-100">
              <div class="w-50 float-left">
                <ul class="list-group w-100">
                  <li class="list-group-item">Username: <span class="info_text"><?php echo $row['user_name'] ?></span></li>
                  <li class="list-group-item">First name: <span class="info_text"><?php echo $row['first_name'] ?></span></li>
                  <li class="list-group-item">Last name: <span class="info_text"><?php echo $row['last_name'] ?></span></li>
                  <li class="list-group-item">Email: <span class="info_text"><?php echo $row['email'] ?></span></li>
                  <li class="list-group-item">Year of birth: <span class="info_text"><?php echo $row['year_of_birth'] ?></span></li>
                  <li class="list-group-item">Favored recepies: <span class="info_text"><?php echo getUserFavoredRecipes($id); ?></span></li>
                </ul>
              </div>
              <div class="w-50 float-left">
                <ul class="list-group w-100">
                  <li class="list-group-item">Recipes: <span class="info_text"><?php echo countUserRecipes($id); ?></span></li>
                  <li class="list-group-item">Average rating: <span class="info_text"><?php echo getAverageRecipeRating($id); ?></span></li>
                  <li class="list-group-item">Highest rating recipe: <span class="info_text"><?php echo getHighestRecipeRating($id); ?></span></li>
                  <li class="list-group-item">Lowest rating recipe: <span class="info_text"><?php echo getLowestRecipeRating($id); ?></span></li>
                  <li class="list-group-item">Followers: <span class="info_text"><?php echo sumFollowers($id); ?></span></li>
                  <li class="list-group-item">Following: <span class="info_text"><?php echo sumFollowing($id); ?></span></li>
                </ul>
              </div>
            </div>
            <div class="">
              <div class="jumbotron" style="margin-top: 305px;">
                <h1 class="display-4">Hello, chef!</h1>
                <p class="lead">Cooking is not difficult. Everyone has taste, even if they don't realize it.
                  Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.</p>
                <hr class="my-4">
              </div>
            </div>
          </div>
        </div>
        <div class="col-8 mt-2"><?php  printAllUserRecepies($id, $id); ?></div>
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
              <form role="form" action="user_password_change.php" method="post">
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
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Change password</button>
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
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="modal fade" id="change_profile_status_modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Change status</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <form role="form" action="" method="post">
                <div class="form-group">
                  <label for="usrname">Change tag</label>
                  <input type="text" class="form-control" id="usrname" placeholder="Enter tag" name="tag">
                </div>
                <div class="form-group">
                  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Change status</label>
                  <input type="text" class="form-control" id="psw" placeholder="Enter new status" name="status">
                </div>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Change status</button>
              </form>
            </div>
            <div class="modal-footer">
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
              <h3>Delete profile picture</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <form role="form" action="delete_profile_picture.php" method="post">
                <div class="form-group">
                  <label>Yes I want to delete profile picture</label>
                  <input type="checkbox" name="check" required>
                </div>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Delete profile picture</button>
              </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="modal fade" id="allergens_modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3>MyAllergens</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <div class="price_list">
                <h3 style="text-align: center;">Ingredient</h3>
                <table  class="table table-hover table-sm border border-dark" style="width: 70%; margin-left: 15%;">
               <thead class="thead-light border border-light"> <tr><th>ID</th><th>Ingredient</th><th>Delete</th></tr></thead>
                <?php
                  $link = connectToDatabase();
                  $sql = "SELECT id, ime FROM namirnica WHERE id IN (SELECT id_namirnica FROM korisnik_namirnica WHERE id_korisnik = $id)";
                  $result = mysqli_query($link, $sql);
                  while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                    print("<tr>");
                    print("<td>" . $row["id"] . "</td><td>" . $row["ime"] . "</td>");
                    print('<td>
                          <form action="remove_allergen.php" method = "POST">
                          <input type="hidden" name="id" value="' . $id . '">
                          <input type="hidden" name="namirnica" value="' . $row["id"] . '">
                          <input type="submit" value="Delete" > </form></td>');
                    print("</tr>");
                  }
                  closeDatabaseConnection($link);
                ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- Optional JavaScript -->
    <script src="popup_change_password_modal.js"></script>
    <script src="popup_change_profile_image_modal.js"></script>
    <script src="popup_change_profile_status_modal.js"></script>
    <script src="popup_delete_profile_image_modal.js"></script>
    <script src="popup_MyAllergens_modal.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
