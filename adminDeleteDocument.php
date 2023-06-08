<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}

if ($_SESSION['permission'] !== 'admin') {
    header("Location: index.php");
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

    $selectedName = $_POST["selectedName"];
    $query = "DELETE FROM fills WHERE Name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedName);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "Document deleted successfully.";
} else {
    echo "Invalid request.";
}
?>
