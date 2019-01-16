<?php

    $servername = "127.0.0.1";
    $username = "student";
    $password = "student";
    $dbname = "ricook";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Uspostavljanje konekcije na bazu nije uspjelo: ". $conn->connect_error);
    }

    //get search term
    $searchTerm = $_POST['term'];

    //get matched data from skills table
    $query = $db->query("SELECT * FROM recept WHERE ime LIKE '%".$searchTerm."%' ORDER BY ime ASC");
    $data = [];
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['name'];
    }

    //return json data
    echo json_encode($data);
?>
?>
