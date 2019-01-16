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
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery-ui.js"></script>
    <link rel="stylesheet" href="jquery-ui.css">
    <script type="text/javascript">
    $(function()
    {
     $( "#find_recipe" ).autocomplete({
      source: 'autocomplete.php'
     });
    });
    </script>

    <title>Homepage</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" href="user_homepage.php">Home</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href="user_friends.php">My Friends</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href="user_profile.php">Profile</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h6 id="homepage_username">User1</h6>
        <div class="nav1_button">
        <button type="button" class="btn btn-secondary" id="add_recipe_button">Add+</button>
        <button type="button" class="btn btn-secondary" id="btn1" onclick="window.location.href='index.php'">Logout</button>
      </div>
      </div>
    </nav>

    <nav class="nav nav-pills nav-fill" role="tablist" class="nav1">
      <a class="nav-item nav-link active" data-toggle="pill" href="">Latest</a>
      <a class="nav-item nav-link" data-toggle="pill" href="">Popular</a>
      <a class="nav-item nav-link" data-toggle="pill" href="">Top rated</a>
    </nav>
    <nav class="nav nav-pills nav-fill" role="tablist" class="nav1">
      <a class="nav-item nav-link active" data-toggle="pill" href="">Any</a>
      <a class="nav-item nav-link" data-toggle="pill" href="">Breakfast</a>
      <a class="nav-item nav-link" data-toggle="pill" href="">Lunch</a>
      <a class="nav-item nav-link" data-toggle="pill" href="">Dinner</a>
      <a class="nav-item nav-link" data-toggle="pill" href="">Dessert</a>
    </nav>

    <div class="jumbotron" id="index_footer">
      <hr class="my-4">
      <h1 class="display-4">Hello, chef!</h1>
      <p class="lead">Cooking is not difficult. Everyone has taste, even if they don't realize it. Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.</p>
    </div>

    <div class="container">
      <div class="modal fade" id="add_recipe_modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Add recipe</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:10px 30px;">
              <form role="form" action="add_recipe.php" method="post">
                <div class="form-group">
                  <label for="exampleFormControlInput1">Recipe</label>
                  <input type="textbox" class="form-control" id="exampleFormControlInput1" placeholder="Dish name" name="dish_name">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Instructions</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="instructions"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Spiciness</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">1</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">2</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">3</label>
                  </div>
                </div>
                <input type="text" name="name" id="find_recipe" list="huge_list">Name
                <datalist id="huge_list"></datalist>

                <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>Add</button>
              </form>
            </div>
            <div class="modal-footer">
              <p>Forgot <a href="">Password?</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <script src="popup_recipe_modal.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
