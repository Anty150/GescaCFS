<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
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

        $nameToRemove = $_POST['Name'];

        $query = "DELETE FROM names WHERE `Name` = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nameToRemove);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully";
        } else {
            echo "Record not found or error deleting record.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
