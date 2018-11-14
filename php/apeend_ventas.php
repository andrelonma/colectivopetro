<?php
    //header('Content-Type: application/json');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "colectivo";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $get_id = "SELECT id FROM registros";
    $result = $conn->query($get_id);

    $id = $result->num_rows+1;

    $request = $_GET;
    $sql = "INSERT INTO  registros (id, ano, valor, id_usuario, id_sede )  VALUES ('{$id}', '{$request['year']}', '{$request['value']}', '0', '{$request['emp']}')";

    if (mysqli_query($conn, $sql)){
        echo true;
    }else {
        echo "Error: " . $sql ."<br>" .mysqli_error($conn);
    }
    $conn->close();
?>