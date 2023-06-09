<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: /GescaCFS/Scripts/PHP/Other/Login/loginScript.php");
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

        $query = "DELETE FROM names WHERE `User ID` = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $userID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Todos los registros eliminados";
        } else {
            echo "Registros no encontrados";
        }

        $stmt->close();
        $conn->close();
    }
}

