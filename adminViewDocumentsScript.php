<?php
session_start();
if(!isset($_SESSION['valid'])){
    header("Location:login.php");
}
if ($_SESSION['permission'] != 'admin') {
    header("Location:index.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedName = $_POST['selectedName'];
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "gescatest";

    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT Content, Time_Created FROM fills WHERE Name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedName);
    $stmt->execute();
    $result = $stmt->get_result();
    $response1 = '';
    $response2 = '';

    if ($result->num_rows > 0) {
        while ($dataResult = $result->fetch_assoc()) {
            $response1 = $dataResult['Content'];
            $response2 = $dataResult['Time_Created'];
        }
    }
    echo $response1 . "#" . $response2;
    $conn->close();
}