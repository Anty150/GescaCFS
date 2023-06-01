<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gescatest";

$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die('Connect Error (' . $connect->connect_errno . ') ' . $connect->connect_error);
}

/*$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('', '', '')";//dokonczyc*/

/*if ($connect->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $connect->error;
}*/

$connect->close();
?>
<body onload="history.go(-1);">
