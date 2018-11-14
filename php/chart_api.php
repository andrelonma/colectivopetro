<?php
    header('Content-Type: application/json');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "colectivo";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT * FROM registros";
    $result = $conn->query($sql);
    $list = array();
    while($row = $result->fetch_assoc()) {
        array_push($list, json_encode($row));
    }
    echo json_encode($list);
    $conn->close();
?>