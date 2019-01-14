<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

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
            <a class="nav-link" href="user_homepage.php?id=<?php echo $_GET['id']; ?>">Home</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link active" href="user_friends.php?id=<?php echo $_GET['id']; ?>">My Friends</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href="user_profile.php?id=<?php echo $_GET['id']; ?>">Profile</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h6 id="homepage_username">User1</h6>
        <button type="button" class="btn btn-secondary" id="btn1" onclick="window.location.href='index.php'">Logout</button>
      </div>
    </nav>

    <div class="row">
      <div class="col-2">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">All</a>
          <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Followers</a>
          <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Following</a>
        </div>
      </div>
      <div class="col-10">
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <?php
              $servername = "127.0.0.1";
              $username = "student";
              $password = "student";
              $dbname = "ricook";

              $conn = new mysqli($servername, $username, $password, $dbname);

              if ($conn->connect_error) {
                die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
              }

              $id = $_GET['id'];
              $sql1 = "SELECT id_pratioc FROM pratitelj WHERE id_pratitelj = $id";
              $result1 = mysqli_query($conn, $sql1);

              while($row1 = $result1->fetch_assoc()) {
                $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratioc]";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = $result2->fetch_assoc();
                echo $row2['first_name'] . $row2['last_name'] . "<br>";
              }

              $sql1 = "SELECT id_pratitelj FROM pratitelj WHERE id_pratioc = $id";
              $result1 = mysqli_query($conn, $sql1);

              while($row1 = $result1->fetch_assoc()) {
                $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratitelj]";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = $result2->fetch_assoc();
                echo $row2['first_name'] . $row2['last_name'] . "<br>";

                for ($i = 0; $i < 100; $i++) echo $row2['first_name'] . $row2['last_name'] . "<br>";
              }

              mysqli_close($conn);
            ?>
          </div>
          <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
            <?php
              $servername = "127.0.0.1";
              $username = "student";
              $password = "student";
              $dbname = "ricook";

              $conn = new mysqli($servername, $username, $password, $dbname);

              if ($conn->connect_error) {
                die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
              }

              $id = $_GET['id'];
              $sql1 = "SELECT id_pratioc FROM pratitelj WHERE id_pratitelj = $id";
              $result1 = mysqli_query($conn, $sql1);

              while($row1 = $result1->fetch_assoc()) {
                $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratioc]";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = $result2->fetch_assoc();
                echo $row2['first_name'] . $row2['last_name'] . "<br>";
              }

              mysqli_close($conn);
            ?>
          </div>
          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
            <?php
              $servername = "127.0.0.1";
              $username = "student";
              $password = "student";
              $dbname = "ricook";

              $conn = new mysqli($servername, $username, $password, $dbname);

              if ($conn->connect_error) {
                die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
              }

              $id = $_GET['id'];
              $sql1 = "SELECT id_pratitelj FROM pratitelj WHERE id_pratioc = $id";
              $result1 = mysqli_query($conn, $sql1);

              while($row1 = $result1->fetch_assoc()) {
                $sql2 = "SELECT first_name, last_name FROM korisnik WHERE id = $row1[id_pratitelj]";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = $result2->fetch_assoc();
                echo $row2['first_name'] . $row2['last_name'] . "<br>";
              }

              mysqli_close($conn);
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="jumbotron" id="index_footer">
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
