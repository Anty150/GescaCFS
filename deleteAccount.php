<?php
session_start();

if (isset($_SESSION['valid'])) {
    $host= "localhost";
    $username = "root";
    $password = "";
    $dbName = "gescatest";

    $conn = new mysqli($host, $username, $password, $dbName);

    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }
    $accountUsername = $_SESSION['username'];
    $query = "DELETE FROM users WHERE User_Name = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $accountUsername);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: newLogout.php');
} else {
    header('Location: login.php');
    exit();
}
?>
