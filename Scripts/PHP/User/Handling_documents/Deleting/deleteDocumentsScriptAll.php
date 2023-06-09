<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location:/GescaCFS/Pages/PHP/Other/Login/login.php");
    exit();
} else {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbName = "gescatest";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli($host, $username, $password, $dbName);

        if ($conn->connect_error) {
            die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
        }
        $userName = $_SESSION['username'];
        $userID = null;

        $stmt = $conn->prepare("SELECT ID FROM users WHERE `User_Name` = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $userID = $row['ID'];
        }
        $stmt->close();

        $query = "DELETE FROM fills WHERE `User_ID` = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $userID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "All records deleted";
        } else {
            echo "Records not found";
        }

        $stmt->close();
        $conn->close();
    }
}
