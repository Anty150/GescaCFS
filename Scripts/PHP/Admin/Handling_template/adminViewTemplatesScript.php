<?php
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: /GescaCFS/Scripts/PHP/Other/Login/loginScript.php");
    exit();
}
if ($_SESSION['permission'] != 'admin') {
    header("Location: /GescaCFS/Pages/PHP/Other/Main/mainPage.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedName_ID = $_POST['selectedID'];
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "gescatest";

    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT `Field Name`, `Type` FROM `field names` WHERE `Name ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedName_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $response = '';

    if ($result->num_rows > 0) {
        while ($dataResult = $result->fetch_assoc()) {
            $response .= $dataResult['Field Name'] . " - " . $dataResult['Type'] . "\n";
        }
    }
    echo $response;
    $conn->close();
}
?>