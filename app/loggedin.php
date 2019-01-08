<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

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
            <a class="nav-link" href="#">Profile <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href="#">My Friends <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href="#">Home <span class="sr-only"></span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button type="button" class="btn btn-secondary" id="btn1">Logout</button>
      </div>
    </nav>
	<nav class="nav nav-pills nav-justified">
		<a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" aria-controls="v-pills-home" aria-selected="true">Popular</a>
		<a class="nav-item nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" aria-controls="v-pills-home" aria-selected="true">Latest</a>
		<a class="nav-item nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" aria-controls="v-pills-home" aria-selected="true">Top rated</a>
	</nav>
	<div class="row">
	  <div class="col-3">
	    <div class="nav flex-column nav-pills" id="v-pills-tab" aria-orientation="vertical">
	      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" aria-controls="v-pills-home" aria-selected="true">All</a>
	      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" aria-controls="v-pills-profile" aria-selected="false">Breakfast</a>
	      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" aria-controls="v-pills-messages" aria-selected="false">Lunch</a>
	      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" aria-controls="v-pills-settings" aria-selected="false">Dinner</a>
	    </div>
	  </div>
	</div>
    <div class="jumbotron">
      <hr class="my-4">
      <h1 class="display-4">Hello, chef!</h1>
      <p class="lead">Cooking is not difficult. Everyone has taste, even if they don't realize it. Even if you're not a great chef, there's nothing to stop you understanding the difference between what tastes good and what doesn't.</p>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
