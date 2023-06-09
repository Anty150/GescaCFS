<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: /GescaCFS/Scripts/PHP/Other/Login/loginScript.php");
    exit();
}
else if ($_SESSION['permission'] != 'admin') {
    header("Location: /GescaCFS/Pages/PHP/Other/Main/mainPage.php");
    exit();
}else {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbName = "gescatest";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli($host, $username, $password, $dbName);

        if ($conn->connect_error) {
            die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
        }

        $selectedName = $_POST['Name'];
        $userId = $_POST['UserID'];

        $query = "DELETE FROM `names` WHERE `Name` = ? AND `User ID` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $selectedName, $userId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Registro eliminado correctamente";
        } else {
            echo "Registro no encontrado o error al borrar registro.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>