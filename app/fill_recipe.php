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
    <title>Add ingredient</title>
  </head>
  <body>

    <?php
      include 'function_script.php';
      $id = $_GET['id'];
      $recipe = $_GET['recipe'];;
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
            <a class="nav-link" href="user_profile.php?id=<?php echo $id; ?>">Profile</a>
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
        <button type="button" class="btn btn-secondary mr-1" id="add_recipe_button">Add Recipe</button>
        <button type="button" class="btn btn-secondary" id="btn1" onclick="window.location.href='index.php'">Logout</button>
      </div>
    </nav>

    <div class="price_list mb-5">
      <h3 style="text-align: center;">Namirnice u receptu</h3>
      <table  class="table table-hover table-sm border border-dark" style="width: 70%; margin-left: 15%;">
     <thead class="thead-light border border-light"> <tr><th>Ime</th><th>Proteini(100g)</th><th>Ugljikohidrati(100g)</th><th>Masti(100g)</th><th>Kcal</th><th>Kolicina</th><th>Opcije</th></tr></thead>
      <?php
        $link = connectToDatabase();
        $sql = "SELECT id_namirnica, kolicina FROM recept_namirnica WHERE id_recept = $recipe";
        $result = mysqli_query($link, $sql);
        $ukupno_protein = 0;
        $ukupno_ugljikohidrati = 0;
        $ukupno_masti = 0;
        $ukupno_kcal = 0;
        $ukupno_kolicina = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
          $ingredient = $row['id_namirnica'];
          $sql2 = "SELECT * FROM namirnica WHERE id = $ingredient";
          $result2 = mysqli_query($link, $sql2);
          $row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
          print("<tr>");
          print("<td>" . $row2["ime"] . "</td><td>" . $row2["protein"] . "</td><td>" . $row2["ugljikohidrati"] . "</td><td>" . $row2["masti"] . "</td><td>" . $row2['kcal'] . "</td><td>" . $row['kolicina'] . "</td>");
          print('<td>
                <form action="recipe_remove_ingredient.php" method="POST">
                <input type="hidden" name="id" value="' . $id . '">
                <input type="hidden" name="namirnica" value="' . $row2["id"] . '">
                <input type="hidden" name="recept" value="' . $recipe . '">
                <input type="submit" value="Izbriši" class="btn btn-danger w-50"> </form></td>');
          print("</tr>");
          $ukupno_protein += $row2["protein"];
          $ukupno_ugljikohidrati += $row2["ugljikohidrati"];
          $ukupno_masti += $row2["masti"];
          $ukupno_kcal += $row2['kcal'];
          $ukupno_kolicina += $row['kolicina'];
        }
        print("<tr><td><b>Ukupno</td><td><b>" . $ukupno_protein . "</td><td><b>" . $ukupno_ugljikohidrati . "</td><td><b>" . $ukupno_masti . "</td><td><b>" . $ukupno_kcal . "</td><td><b>" . $ukupno_kolicina . "</td>");
        print('<td><a class="btn btn-primary w-50" href="see_recipe.php?id='.$id.'&recipe='.$recipe.'">Zavrsi uredivanje</a></td></tr>');
        closeDatabaseConnection($link);
      ?>
      </table>
    </div>

    <div class="price_list mt-5">
      <h3 style="text-align: center;">Namirnice u receptu</h3>
      <table  class="table table-hover table-sm border border-dark" style="width: 70%; margin-left: 15%;">
     <thead class="thead-light border border-light"> <tr><th>Ime</th><th>Proteini(100g)</th><th>Ugljikohidrati(100g)</th><th>Masti(100g)</th><th>kcal(100g)</th><th>Opcije</th></tr></thead>
      <?php
        $link = connectToDatabase();
        $sql = "SELECT * FROM namirnica WHERE id NOT IN (SELECT id_namirnica FROM recept_namirnica WHERE id_recept = $recipe)";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
          print("<tr>");
          print("<td>" . $row["ime"] . "</td><td>" . $row["protein"] . "</td><td>" . $row["ugljikohidrati"] . "</td><td>" . $row["masti"] . "</td><td>" . $row["kcal"] . "</td>");
          print('<td>
                <form action="recipe_add_ingredient.php" method="POST">
                <input type="number" min="1" max="1000" name="kolicina" class="mt-1">
                <input type="hidden" name="id" value="' . $id . '">
                <input type="hidden" name="namirnica" value="' . $row["id"] . '">
                <input type="hidden" name="recept" value="' . $recipe . '">
                <input type="submit" value="Dodaj" class="btn btn-danger w-25"></form></td>');
          print("</tr>");
        }
        closeDatabaseConnection($link);
      ?>
      </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
