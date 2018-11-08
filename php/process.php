<?php
$gsent =  prepare("SELECT value FROM records");
$gsent->execute();

$result = $gsent->fetch(PDO::FETCH_ASSOC);
print_r($result);
$result = $gsent->fetch(PDO::FETCH_BOTH);
print_r($result);
$result = $gsent->fetch(PDO::FETCH_LAZY);
print_r($result);

$result = $gsent->fetch(PDO::FETCH_OBJ);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, value, result FROM records";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Place: " . $row["value"]. " " . $row["result"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>