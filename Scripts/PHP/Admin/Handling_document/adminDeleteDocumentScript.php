<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: /GescaCFS/Scripts/PHP/Other/Login/loginScript.php");
    exit();
}
else if ($_SESSION['permission'] != 'admin') {
    header("Location: /GescaCFS/Pages/PHP/Other/Main/mainPage.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "gescatest";

    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selectedName = $_POST['selectedName'];
    $userId = $_POST['UserID'];

    $query = "DELETE FROM `fills` WHERE `Name` = ? AND `User_ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $selectedName, $userId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "Document deleted successfully.";
} else {
    echo "Invalid request.";
}
?>