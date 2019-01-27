<?php

  function connectToDatabase() {
    $servername = "127.0.0.1";
    $username = "student";
    $password = "student";
    $dbname = "ricook";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
    }
    return $conn;
  }

  function closeDatabaseConnection($conn) {
    mysqli_close($conn);
  }

  function getImage($row) {
    if (substr($row['image'], 0, 3) === "src") return $row['image'];
    return "src/default_avatar.jpg";
  }

  function getRecipeImage($row) {
    if (substr($row['image'], 0, 3) === "src") return $row['image'];
    return "src/default_recipe.png";
  }

  function getUserPersonalInfo($id) {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM korisnik WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row;
  }

  function getRecipeInfo($id) {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM recept WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row;
  }

  function isFollowing($id1, $id2) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) AS count_follow FROM pratitelj WHERE id_pratitelj = $id2 AND id_pratioc = $id1";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    if ($row['count_follow'] > 0) return 1;
    return 0;
  }

  function startFollowing($id, $user) {
    $conn = connectToDatabase();
    $sql = "INSERT INTO pratitelj (id_pratitelj, id_pratioc) VALUES ($user, $id)";
    $result = mysqli_query($conn, $sql);
    closeDatabaseConnection($conn);
  }

  function stopFollowing($id, $user) {
    $conn = connectToDatabase();
    $sql = "DELETE FROM pratitelj WHERE id_pratitelj = $user AND id_pratioc = $id";
    $result = mysqli_query($conn, $sql);
    closeDatabaseConnection($conn);
  }

  function sumFollowers($id) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) as count FROM pratitelj WHERE id_pratitelj = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['count'];
  }

  function sumFollowing($id) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) as count FROM pratitelj WHERE id_pratioc = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['count'];
  }

  function countUserRecipes($id) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) AS brojac FROM recept WHERE id_kreator = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['brojac'];
  }

  function getAverageRecipeRating($id) {
    $conn = connectToDatabase();
    $sql = "SELECT SUM(ocjena) AS a, COUNT(ocjena) AS b FROM recept WHERE id_kreator = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    if ($row['b'] == 0) return 0;
    return ($row['a'] / $row['b']);
  }

  function getHighestRecipeRating($id) {
    $conn = connectToDatabase();
    $sql = "SELECT MAX(ocjena) AS ret FROM recept WHERE id_kreator = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    if (isset($row['ret'])) $row['ret'];
    return 0;
  }

  function getLowestRecipeRating($id) {
    $conn = connectToDatabase();
    $sql = "SELECT MIN(ocjena) AS ret FROM recept WHERE id_kreator = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    if (isset($row['ret'])) $row['ret'];
    return 0;
  }

  function printPersonCard($id, $map) {
    echo ' <div class="card p-1 float-left border border-light m-1 rounded-0">
      <span class="border p-1">
        <img class="slika border" src="' . getImage($map) . '" >
        <div class="d-inline-flex p-1 bd-highlight">Im an inline flexbox container!da da da dd a da da d a da da d a da  da da  da da  da  ad  da da </div>
        <div class="imebtn float-right">
          <h6>' . $map['user_name'] . '</h6>
          <a href="other_profile.php?id=' . $id .'&user=' . $map["id"] .'" value="Unfollow" class="btn btn-primary align-top w-100 mb-1">Visit profile</a> ';

    if (isFollowing($id, $map['id'])) {
      echo ' <form action="stop_following.php" method="post">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="user" value="' . $map["id"] .'">
            <input type="submit" name="submit" value="Unfollow" class="btn btn-primary align-top w-100 mb-1">
            </form> ';
    } else {
      echo ' <form action="start_following.php" method="post">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="user" value="' . $map["id"] .'">
            <input type="submit" name="submit3" value="Follow" class="btn btn-primary align-top w-100 mb-1">
            </form> ';
    }
    echo '   </div></span>
          </div> ';
  }

  function queryPersonCard($result1, $conn, $id) {
    echo ' <div class="user_activity mt-2"> ';
    while($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT * FROM korisnik WHERE id = " . $row1['id'];
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();
      printPersonCard($id, $row2);
    }
    echo ' </div><br> ';
  }

  function printFollowersAndFollowing($id) {
    $conn = connectToDatabase();
    $sql1 = "SELECT id_pratioc AS id FROM pratitelj WHERE id_pratitelj = $id
            UNION
            SELECT id_pratitelj AS id FROM pratitelj WHERE id_pratioc = $id";
    $result1 = mysqli_query($conn, $sql1);
    queryPersonCard($result1, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function printFollowers($id) {
    $conn = connectToDatabase();
    $sql1 = "SELECT id_pratioc AS id FROM pratitelj WHERE id_pratitelj = $id";
    $result1 = mysqli_query($conn, $sql1);
    queryPersonCard($result1, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function printFollowing($id) {
    $conn = connectToDatabase();
    $sql1 = "SELECT id_pratitelj AS id FROM pratitelj WHERE id_pratioc = $id";
    $result1 = mysqli_query($conn, $sql1);
    queryPersonCard($result1, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function showUser($name, $id) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM korisnik WHERE id in (SELECT id FROM korisnik WHERE first_name LIKE ('%$name%') OR last_name LIKE ('%$name%') OR user_name LIKE ('%$name%')) AND id != $id";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }

  function isFavoredby($id_user, $id_recipe) {
    $conn = connectToDatabase();
    $sql = "SELECT id_recept FROM favourite WHERE id_korisnik = $id_user";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
      if ($row['id_recept'] === $id_recipe) {
        closeDatabaseConnection($conn);
        return true;
      }
    }
    closeDatabaseConnection($conn);
    return false;
  }

  function printRecipeCardOnMainpage($id, $map) {
    $row = getUserPersonalInfo($map['id_kreator']);
    echo '
    <div class="card w-100 p-3 mt-1 mb-1 float-left">
      <div mb-2>
         <a href="see_recipe.php?id=' . $id . '&recipe=' . $map['id'] .'"><h3> ' . $map['ime'] . '</a> by <a href="other_profile.php?id=' . $id . '&user=' . $row['id'] . '">' . $row['user_name'] . ' </a></h3>
         <a href="see_recipe.php?id=' . $id . '&recipe=' . $map['id'] .'"><img class="slika2" src=" ' . getRecipeImage($map) . ' "></a>
         <div class="d-inline-flex w-100 h-100 p-3 bd-highlight" id="flex2">Im an inline flexbox container!da da da dd a da da d a da da d a da  da da  da da  da  ad  da da </div>
      </div>
      <table id="tablica" class="table table-sm">
        <thead><tr ><th class="table-success" scope="col">Nutritivne vrijednosti:</th><th class="table-success"></th></tr></thead>
        <tbody>
          <tr class="table-success"><td>Bjelancevine:</td><td>50g</td></tr>
          <tr class="table-success"><td>Ugljikohidrati:</td><td>100g</td></tr>
          <tr class="table-success"><td >Masti:</td><td>30g</td></tr>
        </tbody>
      </table>
      <div class="imebtn2">
        <a class="btn btn-primary align-top text-white">Details</a>
      </div>
    </div> ';
  }

  function queryRecipeCardOnMainpage($result1, $conn, $id) {
    while ($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT * FROM recept WHERE id = " . $row1['id'];
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();
      printRecipeCardOnMainpage($id, $row2);
    }
  }

  function showRecipeOnMainpage($id) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM recept";
    $result = mysqli_query($conn, $sql);
    queryRecipeCardOnMainpage($result, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function showRecipeOnMainpageAny($id) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM recept";
    $result = mysqli_query($conn, $sql);
    queryRecipeCardOnMainpage($result, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function showRecipeOnMainpageBreakfast($id) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = 1)";
    $result = mysqli_query($conn, $sql);
    queryRecipeCardOnMainpage($result, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function showRecipeOnMainpageLunch($id) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = 2)";
    $result = mysqli_query($conn, $sql);
    queryRecipeCardOnMainpage($result, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function showRecipeOnMainpageDinner($id) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = 3)";
    $result = mysqli_query($conn, $sql);
    queryRecipeCardOnMainpage($result, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function showRecipeOnMainpageDessert($id) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = 4)";
    $result = mysqli_query($conn, $sql);
    queryRecipeCardOnMainpage($result, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function printRecipeCardOnProfile($row_recipe, $id) {
    $row_user = getUserPersonalInfo($row_recipe['id_kreator']);

    echo ' <div class="card w-25 p-2 rounded-0 float-left" style="height: 400px;">
       <h3><a href="see_recipe.php?id=' . $id . '&recipe=' . $row_recipe['id'] .'"> ' . $row_recipe['ime'] . ' </a></h3>
       <img class="" src=" ' . getRecipeImage($row_recipe) . ' ">
      <input type="button" name="submit" value="Favorite" class="btn btn-primary w-100">
    </div> ';
  }

  function queryRecipeCardOnProfile($result1, $conn, $id) {
    while ($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT * FROM recept WHERE id = " . $row1['id'];
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();
      printRecipeCardOnProfile($row2, $id);
    }
  }

  function printAllUserRecepies($id) {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM recept WHERE id_kreator = $id";
    $result1 = mysqli_query($conn, $sql);
    queryRecipeCardOnProfile($result1, $conn, $id);
    closeDatabaseConnection($conn);
  }

  function printIngredietCard($id, $map) {
    echo ' <div class="card p-1 float-left border border-light m-1 rounded-0">
        <h4>' . $map['ime'] . '</h4>
        <img class="border w-100" src="' . getImage(getUserPersonalInfo(450)) . '" >
        <ul class="list-group w-100" id="namirnice_search_lista">
        <li class="list-group-item">Protein: ' . $map['protein'] . '</li><br>
        <li class="list-group-item">Carbs: ' . $map['ugljikohidrati'] . '</li><br>
        <li class="list-group-item">Fat: ' . $map['masti'] . '</li><br>
        <li class="list-group-item">Calorie: ' . $map['kcal'] . '</li></ul>
      </div> ';
  }

  function queryIngredientCard($result1, $conn, $id) {
    while($row1 = $result1->fetch_assoc()) {
      $sql2 = "SELECT * FROM namirnica WHERE id = " . $row1['id'];
      $result2 = mysqli_query($conn, $sql2);
      $row2 = $result2->fetch_assoc();
      printIngredietCard($id, $row2);
    }
  }

  function showIngredient($name) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM namirnica";
    $result = mysqli_query($conn, $sql);
    queryIngredientCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }

  function showTag($name) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM korisnik";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }

  function showEvent($name) {
    $conn = connectToDatabase();
    $sql = "SELECT id FROM korisnik";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, 1);
    closeDatabaseConnection($conn);
  }

  function countFavorites($id) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) as brojac FROM favourite WHERE id_recept = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['brojac'];
  }

  function isCreator($id, $recipe) {
    $row = getRecipeInfo($recipe);
    if ($row['id_kreator'] === $id) return true;
    return false;
  }
?>
