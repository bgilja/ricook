<?php
  $id = $_POST['id'];
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
  $query = "DELETE FROM namirnica WHERE id = " . $id;
  $result = mysqli_query($link, $query);
  //  Zatvaranje konekcije
  mysqli_close($link);
  header( 'Location: dario.php?id=1');
?>