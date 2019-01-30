<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_modal.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Explore<span class="sr-only"></span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
      <div class="nav1_button">
        <button type="button" class="btn btn-secondary" id="login_button">Login</button>
        <button type="button" class="btn btn-secondary" id="register_button" onclick="window.location.href='register.php'">Register</button>
      </div>
      </div>
    </nav>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="src/home_slide1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="src/home_slide2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="src/home_slide3.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


    <div class="events">
      <h3>Events</h3>
      <span>
        <a href="https://www.thechocolateshow.co.uk/?ref=organicgglunkwn&prid=pfseogglunkwn">
          <div class="card" style="width: 18rem;">
            <img src="https://i.ytimg.com/vi/qkmbpYe4E70/maxresdefault.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Chocolate Show New York</h5>
              <p class="card-text">Every November, people gather to see the unique ways chocolate is used in this festival.</p>
              </a>
            </div>
          </div>
      </span>
      <span>
        <a href="https://pizzafestival.ca/">
          <div class="card" style="width: 18rem;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOItDXaqo4_wGvvBPA_5dU1zURh-rN-IH0g9V8fO7pP3uSudZy" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Pizza festival Toronto</h5>
              <p class="card-text">Toronto’s top pizza joints and Italian restaurants come together for Toronto’s first ever PIZZA FEST</p>
              </a>
            </div>
          </div>
      </span>
      <span>
        <a href="http://www.fieryfoodsshow.com/">
          <div class="card" style="width: 18rem;">
            <img src="https://dailyhealthremedies.com/wp-content/uploads/2015/04/spicy-foods-and-takeaway.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">National Fiery Foods - New Mexico</h5>
              <p class="card-text">There's no better place to satisfy your craving for flavor and fire.</p>
              </a>
            </div>
          </div>
      </span>
    </div>

    <div class="jumbotron" id="index_footer">
      <hr class="my-4">
      <h1 class="display-4">About us</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>

    <div class="container">
      <div class="modal fade" id="login_modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Login</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <form role="form" action="login_process.php" method="post">
                <div class="form-group">
                  <label for="usrname">Username</label>
                  <input type="text" class="form-control" id="usrname" placeholder="Enter username" name="login_username">
                </div>
                <div class="form-group">
                  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                  <input type="text" class="form-control" id="psw" placeholder="Enter password" name="login_password">
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="" checked> Remember me</label>
                </div>
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
    <!-- Optional JavaScript -->
    <script src="popup_modal.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
