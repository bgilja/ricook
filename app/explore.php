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

    <title>Homepage</title>
  </head>
  <body class="">

    <?php
      include 'function_script.php';
      $id = $_GET['id'];
      if (isset($_GET['state'])) $state = $_GET['state'];
      else $state = 0;
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
            <a class="nav-link active" href="index.php">Home</a>
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
      </div>
    </nav>

    <div class="user_homepage_nav">
      <div class="row1">
        <nav class="nav nav-pills nav-fill" role="tablist">
          <a class="nav-item nav-link border border-dark rounded-0 text-white <?php if ($state == 0) echo "active"; ?>" href="explore.php?id=<?php echo $id; ?>&state=0">Latest</a>
          <a class="nav-item nav-link border border-dark rounded-0 text-white <?php if ($state == 1) echo "active"; ?>" href="explore.php?id=<?php echo $id; ?>&state=1">Popular</a>
          <a class="nav-item nav-link border border-dark rounded-0 text-white <?php if ($state == 2) echo "active"; ?>" href="explore.php?id=<?php echo $id; ?>&state=2">Top rated</a>
        </nav>
      </div>
      <div class="tab-content w-75" id="nav-tabContent" style="margin-left: 12%;">
      </div>
      <div class="row1">
          <nav class="nav nav-pills nav-fill" role="tablist">
            <a class="nav-item nav-link border border-dark rounded-0 text-white active" id="list-any-list" data-toggle="list" href="#list-any" role="tab" aria-controls="any">Any</a>
            <a class="nav-item nav-link border border-dark rounded-0 text-white" id="list-breakfast-list" data-toggle="list" href="#list-breakfast" role="tab" aria-controls="breakfast">Breakfast</a>
            <a class="nav-item nav-link border border-dark rounded-0 text-white" id="list-lunch-list" data-toggle="list" href="#list-lunch" role="tab" aria-controls="lunch">Lunch</a>
            <a class="nav-item nav-link border border-dark rounded-0 text-white" id="list-dinner-list" data-toggle="list" href="#list-dinner" role="tab" aria-controls="dinner">Dinner</a>
            <a class="nav-item nav-link border border-dark rounded-0 text-white" id="list-dessert-list" data-toggle="list" href="#list-dessert" role="tab" aria-controls="dessert">Dessert</a>
          </nav>
      </div>

      <div class="tab-content w-75" id="nav-tabContent" style="margin-left: 12%;">
        <div class="tab-pane fade show active" id="list-any" role="tabpanel" aria-labelledby="list-main-list"><?php for ($i = 0; $i < 1; $i++) showRecipeOnMainpage($id, 0, $state); ?></div>
        <div class="tab-pane fade" id="list-breakfast" role="tabpanel" aria-labelledby="list-main-list"><?php for ($i = 0; $i < 1; $i++) showRecipeOnMainpage($id, 1, $state); ?></div>
        <div class="tab-pane fade" id="list-lunch" role="tabpanel" aria-labelledby="list-main-list"><?php for ($i = 0; $i < 1; $i++) showRecipeOnMainpage($id, 2, $state); ?></div>
        <div class="tab-pane fade" id="list-dinner" role="tabpanel" aria-labelledby="list-main-list"><?php for ($i = 0; $i < 1; $i++) showRecipeOnMainpage($id, 3, $state); ?></div>
        <div class="tab-pane fade" id="list-dessert" role="tabpanel" aria-labelledby="list-main-list"><?php for ($i = 0; $i < 1; $i++) showRecipeOnMainpage($id, 4, $state); ?></div>
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
