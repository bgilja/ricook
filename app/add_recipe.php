<?php


  $ime = $_POST['dish_name'];
  $upute = $_POST['instructions'];
  $id = -1;

  $servername = "127.0.0.1";
  $username = "student";
  $password = "student";
  $dbname = "ricook";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
  }

  $sql = "INSERT INTO recept (ime , upute)
          VALUES ('$ime', '$upute')";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();


  if(!$result){
    echo "Bravo";
}else{
    echo "Error!". mysql_error();
    //Remove Below comment if you want to also popup an alert on error
    /**echo '<script type="application/javascript">alert("Error! '.mysql_error().'");</script>';*/
}

?>
