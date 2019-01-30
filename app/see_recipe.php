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

    <title>Recipe</title>
  </head>
  <body>

    <?php
      include 'function_script.php';
      $id = $_GET['id'];
      $recipe = $_GET['recipe'];
      $conn = connectToDatabase();
      incrementViewsCount($recipe, $conn);
      $row = getRecipeInfo($recipe);
      $user_info = getUserPersonalInfo($row['id_kreator']);

      session_start();
      if ( isset( $_SESSION['user_id'] ) ) {
      } else {
          header("Location: index.php");
      }
    ?>

    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
       <a class="navbar-brand" href="index.php"><img style="width: 110px;" src="src/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="user_homepage.php?id=<?php echo $id; ?>">Home</a>
          </li>
          <?php
            if ($id != 0) {
              echo '  <li class="nav-item">
                        <a class="nav-link" href="user_friends.php?id='.$id.'">My Friends</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="user_profile.php?id=' .$id . '">Profile</a>
                      </li>';
            }
          ?>
          <?php
          if ($id == 1) {
            echo '  <li class="nav-item">
                      <a class="nav-link" href="add_ingredient.php?id=' .$id . '">Add ingredient</a>
                    </li>' ;
          }
          ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search" action="search.php?id=<?php echo $id; ?>" method="post">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="string" required>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <?php
          if ($id != 0) {
            echo '  <h6 id="homepage_username">'.$user_info['user_name'].'</h6>
                    <button type="button" class="btn btn-success mr-1" data-toggle="modal" data-target="#add_recipe" style="width: 120px;">Add Recipe</button>
                    <form method = "post" action="logout.php">
                    <input type="submit" class="btn btn-secondary" name="logout" style="width: 120px;" value = "Logout"></input>
                    </form> ';
          }
        ?>
      </div>
    </nav>

    <div class="user_profile_page h-100 w-100">
      <div class="row w-100 h-100">
          <div class="col-4 p-1 pl-4 pr-3 h-100" style="background-color: grey;">
          <div class="user_information_block">
            <div class="user_block" id="user_block1">
              <img class="rounded border float-left mw-75 h-75" style="margin-top: 35px;" src=" <?php echo getRecipeImage($row); ?>">
              <div class="profile_buttons" >
                <?php
                 if (!isFavoredby($id, $recipe) && $id != 0) {
                  echo ' <form class="" action="add_to_favourites.php" method="post">
                    <input type="hidden" name="id" value="'. $id .'">
                    <input type="hidden" name="recipe" value="'. $recipe .'">
                    <input type="submit" class="btn btn-primary w-25 ml-1" style="margin-top: 100px;" value="Favor">
                  </form> ';
                } else if ($id != 0) {
                  echo ' <form class="" action="remove_from_favourites.php" method="post">
                    <input type="hidden" name="id" value="'. $id .'">
                    <input type="hidden" name="recipe" value="'. $recipe .'">
                    <input type="submit" class="btn btn-primary w-25 ml-1" style="margin-top: 100px;" value="Unfavor">
                  </form> ';
                }
                if (isCreator($id, $recipe)) {
                  echo ' <button type="button" class="btn btn-danger mt-1 w-25" data-toggle="modal" data-target="#delete_recipe">Delete recipe</button> ';
                }
                if ($id != 0) {
                  echo ' <button type="button" class="btn btn-info mt-1 w-25" data-toggle="modal" data-target="#give_rating">Give rating</button> ';
                }
                ?>
              </div>
            </div>
            <div class="user_block">
                <ul class="list-group w-100">
                  <li class="list-group-item">Created by: <span class="info_text"><?php echo $user_info['user_name']; ?></span></li>
                  <li class="list-group-item">Views count: <span class="info_text"><?php echo $row['broj_pregleda']; ?></span></li>
                  <li class="list-group-item">Rated by: <span class="info_text"><?php echo getRecipeRatingCount($recipe); ?></span></li>
                  <li class="list-group-item">Rating: <span class="info_text"><?php echo getRecipeRatingValue($recipe); ?></span></li>
                  <li class="list-group-item">Favored by: <span class="info_text"><?php echo countFavorites($recipe); ?></span></li>
                  <?php
                    if ($id != 0) {
                      echo ' <li class="list-group-item">Your rating: <span class="info_text">'. getUserRatingForRecipe($id, $recipe) .'</span></li> ';
                    }
                  ?>
                </ul>
            </div>
            <div class="table" style="height: 500px;">
              <table id="tablica" class="table table-sm">
                <thead><tr ><th class="table-success" scope="col">Ingredients</th><th class="table-success">Amount</th><th class="table-success">KCal</th></tr></thead>
                <tbody>
                  <?php
                  $sql = "SELECT id_namirnica, kolicina FROM recept_namirnica WHERE id_recept = $recipe";
                  $result = mysqli_query($conn, $sql);
                  $ukupno_kolicina = 0;
                  $ukupno_kalorija = 0;
                  while ($row2 = $result->fetch_assoc()) {
                    $sql2 = "SELECT ime, kcal FROM namirnica WHERE id = ". $row2['id_namirnica'];
                    $result2 = mysqli_query($conn, $sql2);
                    $row3 = $result2->fetch_assoc();
                    echo '<tr class="table-success"><td>'. $row3['ime'].'</td><td>'.$row2['kolicina'].'</td><td>'. $row3['kcal'].'</td></tr>';
                    $ukupno_kolicina += $row2['kolicina'];
                    $ukupno_kalorija += $row3['kcal'];
                  }
                  echo '<tr class="table-success"><td><b>Ukupno</td><td><b>'.$ukupno_kolicina.'</td><td><b>'. $ukupno_kalorija .'</td></tr>';
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-8 float-left">
          <div class="mt-2">
            <div class="jumbotron" id="user_jumbotron">
              <h1 class="display-4">Upute</h1>
              <p class="lead">
                <?php echo $row['upute']; ?>
              </p>
              <hr class="my-4">
            </div>
          </div>
          <div class="panel panel-default">
            <table class="table table-hover" style="background-color: white">
             <thead><tr><th scope="row">Comments</th><th></th><th></th></tr></thead>
             <tbody>
               <col width="40">
               <col width="80">
               <col width="750">
                   <?php
                     $comments = "SELECT * FROM komentar WHERE id_recept = $recipe";
                     $result = mysqli_query($conn, $comments);
                     while ($row2 = $result->fetch_assoc()) {
                       $row3 = getUserPersonalInfo($row['id_kreator']);
                       echo ' <tr>
                         <td>
                           <img class="rounded border float-left" src="' . getImage($row3) . '" style="width: 100%; height: 80px;">
                         </td>
                         <td style="width: 100px;">
                           <p>' . $row3['user_name'] . '</p>
                         </td>
                         <td>
                           <p>' . $row2['tekst'] . '</p>
                         </td>
                         <td style="width: 130px;"">
                           <p>' . $row2['vrijeme'] . '</p>
                         </td>
                       </tr>';
                     }
                     closeDatabaseConnection($conn);
                   ?>

             </tbody>
           </table>
          <?php
            if ($id != 0) {
              echo ' <div class="panel-heading">Submit Your Comments</div>
                      <div class="panel-body">
                        <form method="post" action="add_comment.php">
                        	<div class="form-group">
                        	  <textarea name="comment" class="form-control" rows="3"></textarea>
                        	</div>
                          <input type="hidden" name="id" value= "'. $id .'">
                          <input type="hidden" name="recipe" value="'. $recipe .'">
                        	<button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div> ';
            }
          ?>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="give_rating" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header" style="background-color: rgb(130, 160, 210);">
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
                <button type="submit" class="btn btn-primary w-100 btn-block"><span class="glyphicon glyphicon-off"></span>Rate</button>
            </form>
          </div>
          <div class="modal-footer">
            <?php
            if (getUserRatingForRecipe($id, $recipe) > 0) {
                echo '<h6>*You already gave rating to this recipe. New rating will delete previous.</h6>';
              } else {
                echo '<h6>*Your rating will be saved.</h6>';
              }
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="delete_recipe" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header" style="background-color: rgb(130, 160, 210);">
            <h3>Delete recipe</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" style="padding:40px 50px;">
            <form class="mt-1" action="delete_recipe.php" method="post">
              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input" name="breakfast" id="customControlInline1" required>
                <label class="custom-control-label" for="customControlInline1">Yes I'm sure I want to delete this recipe.</label>
              </div>
              <input type="hidden" name="id" value="'. $id .'">
              <input type="hidden" name="recipe" value="'. $recipe .'">
              <button type="submit" class="btn btn-primary w-100 btn-block"><span class="glyphicon glyphicon-off"></span>Delete recipe</button>
            </form>
          </div>
          <div class="modal-footer">
            <h6>*This will remove recipe from database.</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="add_recipe" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: rgb(130, 160, 210);">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="add_recipe.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Recipe</label>
                <input type="textbox" class="form-control" required placeholder="Dish name" name="dish_name">
              </div>
              <div class="form-group">
                <label>Instructions</label>
                <textarea class="form-control" rows="7" name="instructions" required></textarea>
              </div>
              <div class="form-row">
                <h6 class="mt-2">You will add ingredients later</h6>
              </div>
              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input" name="breakfast" id="customControlInline1">
                <label class="custom-control-label" for="customControlInline1">Breakfast</label>
              </div>
              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input" name="lunch" id="customControlInline2">
                <label class="custom-control-label" for="customControlInline2">Lunch</label>
              </div>
              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input" name="dinner" id="customControlInline3">
                <label class="custom-control-label" for="customControlInline3">Dinner</label>
              </div>
              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input" name="dessert" id="customControlInline4">
                <label class="custom-control-label" for="customControlInline4">Dessert</label>
              </div>
              <div class="">
                <h6>Select image to upload: <label class="btn btn-primary btn-file ml-3">Browse<input type="file" name="fileToUpload" style="display: none;"></label></h6>
              </div>
              <datalist id="huge_list"></datalist>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-off"></span>Continue</button>
            </form>
          </div>
          <div class="modal-footer">
            <h6 class="float-right">*You will add ingredients later</h6>
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
