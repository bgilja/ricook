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

  function calculateIngredientCalories($protein, $carbs, $fat) {
    return round(($protein+$carbs)*4 + $fat*9);
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

  function getIngredintInfo() {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM namirnica WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row;
  }

  function returnSQLResult($sql) {
    $conn = connectToDatabase();
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row;
  }

  function countFavorites($id) {
    $sql = "SELECT COUNT(*) as brojac FROM favourite WHERE id_recept = $id";
    return returnSQLResult($sql)['brojac'];
  }

  function incrementViewsCount($recipe, $conn) {
    $sql = "UPDATE recept SET broj_pregleda = broj_pregleda+1 WHERE id = $recipe";
    $result = mysqli_query($conn, $sql);
  }

  function isFollowing($id1, $id2) {
    $sql = "SELECT COUNT(*) AS count_follow FROM pratitelj WHERE id_pratitelj = $id2 AND id_pratioc = $id1";
    return returnSQLResult($sql)['count_follow'];
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
    $sql = "SELECT COUNT(*) as count FROM pratitelj WHERE id_pratitelj = $id";
    return returnSQLResult($sql)['count'];
  }

  function sumFollowing($id) {
    $sql = "SELECT COUNT(*) as count FROM pratitelj WHERE id_pratioc = $id";
    return returnSQLResult($sql)['count'];
  }

  function countUserRecipes($id) {
    $sql = "SELECT COUNT(*) AS brojac FROM recept WHERE id_kreator = $id";
    return returnSQLResult($sql)['brojac'];
  }

  function getAverageRecipeRating($id) {
    $sql = "SELECT SUM(ocjena) AS a, COUNT(ocjena) AS b FROM rejting WHERE id_recept IN (SELECT id FROM recept WHERE id_kreator = $id)";
    $row = returnSQLResult($sql);
    if ($row['b'] == 0) return 0;
    return round($row['a'] / $row['b'], 2);
  }

  function getHighestRecipeRating($id) {
    $sql = "SELECT MAX(ocjena) AS ret FROM rejting WHERE id_recept IN (SELECT id FROM recept WHERE id_kreator = $id)";
    $row = returnSQLResult($sql);
    if (isset($row['ret'])) return $row['ret'];
    return "Not rated";
  }

  function getLowestRecipeRating($id) {
    $sql = "SELECT MIN(ocjena) AS ret FROM rejting WHERE id_recept IN (SELECT id FROM recept WHERE id_kreator = $id)";
    $row = returnSQLResult($sql);
    if (isset($row['ret'])) return $row['ret'];
    return "Not rated";
  }

  function getUserRatingForRecipe($id, $recipe) {
    $sql = "SELECT SUM(ocjena) AS a FROM rejting WHERE id_recept = $recipe AND id_korisnik = $id";
    if (isset($row['a'])) return $row['a'];
    return "Not rated";
  }

  function getUserFavoredRecipes($id) {
    $sql = "SELECT COUNT(*) AS a FROM favourite WHERE id_korisnik = $id";
    return returnSQLResult($sql)['a'];
  }

  function getRecipeRatingCount($recipe) {
    $sql = "SELECT COUNT(*) AS a FROM rejting WHERE id_recept = $recipe";
    return returnSQLResult($sql)['a'];
  }

  function getRecipeRatingValue($recipe) {
    $sql = "SELECT SUM(ocjena) AS a, COUNT(ocjena) AS b FROM rejting WHERE id_recept = $recipe";
    $row = returnSQLResult($sql);
    if ($row['b'] == 0) return 0;
    return round($row['a'] / $row['b'], 2);
  }

  function isFavoredby($id_user, $id_recipe) {
    $sql = "SELECT COUNT(*) AS a FROM favourite WHERE id_korisnik = $id_user AND id_recept = $id_recipe";
    return returnSQLResult($sql)['a'];
  }

  function isCreator($id, $recipe) {
    $row = getRecipeInfo($recipe);
    if ($row['id_kreator'] == $id) return true;
    return false;
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
    $sql = "SELECT id_pratioc AS id FROM pratitelj WHERE id_pratitelj = $id UNION SELECT id_pratitelj AS id FROM pratitelj WHERE id_pratioc = $id";
    $result = mysqli_query($conn, $sql);
    queryPersonCard($result, $conn, $id);
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
    queryPersonCard($result, $conn, $id);
    closeDatabaseConnection($conn);
  }

   function printRecipeCardOnMainpage($id, $map) {
    $row = getUserPersonalInfo($map['id_kreator']);
    echo '
    <div class="card w-100 p-1 mt-1 mb-1 float-left">
      <div class="w-100">
         <a class="" href="see_recipe.php?id=' . $id . '&recipe=' . $map['id'] .'"><h3> ' . $map['ime'] . '</a> by <a href="other_profile.php?id=' . $id . '&user=' . $row['id'] . '">' . $row['user_name'] . ' </a></h3>
      </div>
      <div>
        <a href="see_recipe.php?id=' . $id . '&recipe=' . $map['id'] .'"><img class="slika2 w-25 card p-1" src=" ' . getRecipeImage($map) . ' "></a>
        <div class="d-inline-flex w-100 h-100 p-1" style="margin-left: 400px; margin-top:-220px;">
         <p>Im an inline flexbox container!da da da dd a da da d a da da d a da  da da  da da  da  ad  da da </p>
        </div>
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

  function showRecipeOnMainpageSQL($id, $meal, $state) {
    if ($state == 0) $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = $meal) ORDER BY id DESC";
    else if ($state == 1) $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = $meal) ORDER BY broj_pregleda DESC";
    else if ($state == 2) $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = $meal) ORDER BY ocjena DESC";
    else $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM recept_obrok WHERE obrok = $meal) AND id IN (SELECT id_recept FROM favourite WHERE id_korisnik = $id)";
    return $sql;
  }

  function showRecipeOnMainpageSQLAny($id, $state) {
    if ($state == 0) $sql = "SELECT id FROM recept ORDER BY id DESC";
    else if ($state == 1) $sql = "SELECT id FROM recept ORDER BY broj_pregleda DESC";
    else if ($state == 2) $sql = "SELECT id FROM recept ORDER BY ocjena DESC";
    else $sql = "SELECT id FROM recept WHERE id IN (SELECT id_recept FROM favourite WHERE id_korisnik = $id)";
    return $sql;
  }

  function showRecipeOnMainpage($id, $meal, $state) {
    if ($meal == 0) $sql = showRecipeOnMainpageSQLAny($id, $state);
    else $sql = showRecipeOnMainpageSQL($id, $meal, $state);

    $conn = connectToDatabase();
    pagingAndQuery($conn, $sql, $id, $state);
    closeDatabaseConnection($conn);
  }

  function pagingAndQuery($conn, $sql, $id, $state) {
    $rowsperpage = 1;
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    $totalpages = ceil($numrows / $rowsperpage);
    if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
       $currentpage = (int) $_GET['currentpage'];
    } else {
       $currentpage = 1;
    }
    if ($currentpage > $totalpages) {
       $currentpage = $totalpages;
    }
    if ($currentpage < 1) {
       $currentpage = 1;
    }
    $offset = ($currentpage - 1) * $rowsperpage;
    $limit = "LIMIT $offset, $rowsperpage";
    $sql = $sql . " " . $limit;
    $result = mysqli_query($conn, $sql);
    $range = 3;
    $serverself = "{$_SERVER['PHP_SELF']}";

    echo ' <nav class="float-left mt-1"><ul class="pagination"> ';
    if ($currentpage > 1) {
        echo ' <li class="page-item"><a class="page-link" href="'.$serverself.'?currentpage=1&id='.$id.'&state='.$state.'">First page</a> ';
       $prevpage = $currentpage - 1;
    }

    for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
       if (($x > 0) && ($x <= $totalpages) && ($totalpages > 1)) {
          if ($x == $currentpage) {
             echo ' <li class="page-item"><b class="page-link">['.$x.']</b> ';
          } else {
             echo ' <li class="page-item"><a class="page-link" href="'.$serverself.'?currentpage='.$x.'&id='.$id.'&state='.$state.'">'.$x.'</a> ';
          }
       }
    }

    if (($currentpage != $totalpages) && ($totalpages > 1)) {
       $nextpage = $currentpage + 1;
       echo ' <li class="page-item"><a class="page-link" href="'.$serverself.'?currentpage='.$totalpages.'&id='.$id.'&state='.$state.'">Last page</a> ';
    }

    echo ' </ul></nav>';
    if ($totalpages > 1) echo '<br><br><br>';

    if ($state == -1) queryRecipeCardOnProfile($result, $conn, $id);
    else queryRecipeCardOnMainpage($result, $conn, $id);
  }

  function printAllUserRecepiesOnOtherProfile($id, $user) {
    $sql = "SELECT * FROM recept WHERE id_kreator = $user";
    $conn = connectToDatabase();
    pagingAndQueryOnOtherProfile($conn, $sql, $id, $user);
    closeDatabaseConnection($conn);
  }

  function pagingAndQueryOnOtherProfile($conn, $sql, $id, $user) {
    $rowsperpage = 1;
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    $totalpages = ceil($numrows / $rowsperpage);
    if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
       $currentpage = (int) $_GET['currentpage'];
    } else {
       $currentpage = 1;
    }
    if ($currentpage > $totalpages) {
       $currentpage = $totalpages;
    }
    if ($currentpage < 1) {
       $currentpage = 1;
    }
    $offset = ($currentpage - 1) * $rowsperpage;
    $limit = "LIMIT $offset, $rowsperpage";
    $sql = $sql . " " . $limit;
    $result = mysqli_query($conn, $sql);
    $range = 3;
    $serverself = "{$_SERVER['PHP_SELF']}";
    echo ' <nav class="float-left mt-1"><ul class="pagination"> ';
    if ($currentpage > 1) {
        echo ' <li class="page-item"><a class="page-link" href="'.$serverself.'?currentpage=1&id='.$id.'&user='.$user.'">First page</a> ';
       $prevpage = $currentpage - 1;
    }
    for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
       if (($x > 0) && ($x <= $totalpages) && ($totalpages > 1)) {
          if ($x == $currentpage) {
             echo ' <li class="page-item"><b class="page-link">['.$x.']</b> ';
          } else {
             echo ' <li class="page-item"><a class="page-link" href="'.$serverself.'?currentpage='.$x.'&id='.$id.'&user='.$user.'">'.$x.'</a> ';
          }
       }
    }
    if (($currentpage != $totalpages) && ($totalpages > 1)) {
       $nextpage = $currentpage + 1;
       echo ' <li class="page-item"><a class="page-link" href="'.$serverself.'?currentpage='.$totalpages.'&id='.$id.'&user='.$user.'">Last page</a> ';
    }
    echo ' </ul></nav>';
    if ($totalpages > 1) echo '<br><br><br>';
    queryRecipeCardOnProfile($result, $conn, $id);
  }

  function printRecipeCardOnProfile($row_recipe, $id) {
    $row_user = getUserPersonalInfo($row_recipe['id_kreator']);

    echo ' <div class="card w-25 p-2 rounded-0 float-left" style="height: 350px;">
       <h3><a href="see_recipe.php?id=' . $id . '&recipe=' . $row_recipe['id'] .'"> ' . $row_recipe['ime'] . ' </a></h3>
       <img class="" src=" ' . getRecipeImage($row_recipe) . ' " width = 100%>
      <input type="button" name="submit" value="Favorite" class="btn btn-primary w-100 mt-3 card text-dark">
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
    pagingAndQuery($conn, $sql, $id, -1);
  }

  function userAllergen($id, $ingredient) {
    $conn = connectToDatabase();
    $sql = "SELECT COUNT(*) AS a FROM korisnik_namirnica WHERE id_korisnik = $id AND id_namirnica = $ingredient";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    closeDatabaseConnection($conn);
    return $row['a'];
  }

  function printIngredietCard($id, $map) {
    echo ' <div class="card p-1 float-left border border-light m-1 rounded-0">
        <h4>' . $map['ime'] . '</h4>
        <img class="border w-100" src="' . getImage(getUserPersonalInfo(450)) . '" >
        <ul class="list-group w-100">
        <li class="list-group-item">Protein: ' . $map['protein'] . '</li><br>
        <li class="list-group-item">Carbs: ' . $map['ugljikohidrati'] . '</li><br>
        <li class="list-group-item">Fat: ' . $map['masti'] . '</li><br>
        <li class="list-group-item">Calorie: ' . $map['kcal'] . '</li></ul>';
    if (userAllergen($id, $map['id'])) {
      echo ' <form action="remove_allergen.php" method="post">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="namirnica" value="' . $map["id"] .'">
            <input type="submit" name="submit" value="Remove from allergens" class="btn btn-primary align-top w-100 mb-1">
            </form> ';
    } else {
      echo ' <form action="add_allergen.php" method="post">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="namirnica" value="' . $map["id"] .'">
            <input type="submit" name="submit3" value="Add to allergens" class="btn btn-danger align-top w-100 mb-1">
            </form> ';
    }
    echo '  </div> ';
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
?>
