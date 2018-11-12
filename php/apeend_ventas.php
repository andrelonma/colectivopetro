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

$sql = "SELECT id FROM registros";
$result = $conn->query($sql);
$id = $result['num_rows'];
$request = $_GET['data'];

$sql = "INSERT INTO  registros (id, ano, valor, id_usuario, id_sede )
       VALUES ("+$id+", "+request['year']+", "+request['value']+", "+$_SESSION['id']+", "+request['emp']+")";
if (mysqli_query($conn, $sql)){
    echo "New record created successfully";
}else {
    echo "Error: " . $sql ."<br>" .mysqli_error($conn);
}
$conn->close();
?>