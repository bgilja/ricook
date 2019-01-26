<?php
  $ime = $_POST['ime'];
  $protein = $_POST['protein'];
  $ugljikohidrati = $_POST['ugljikohidrati'];
  $masti = $_POST['masti'];
  $kcal = $_POST['kcal'];
  $servername = "127.0.0.1";
  $username = "student"; //promjenio zbog baze na svom računalu, K
  $password = "student"; //promjenio zbog baze na svom računalu, K
  $dbname = "ricook";
  // Stvaranje konekcije na bazu
  $link = new mysqli($servername, $username, $password, $dbname);
  // Provjera uspjesnosti spajanja na bazu
  if ($link->connect_error) {
    die("Uspostavljanje konekcije na bazu nije uspjelo: ". $link->connect_error);
  }
  
    
    $query = "INSERT INTO `namirnica`(`ime`, `protein`, `ugljikohidrati`, `masti`, `kcal`) VALUES ('" . $ime . "', '" . $protein . "', '" . $ugljikohidrati . "', '" . $masti . "','" . $kcal . "')";

  $result = mysqli_query($link, $query);
  //  Zatvaranje konekcije
  mysqli_close($link);
  header( 'Location: dario.php?id=1');
?>