<?php
session_start();
if(!isset($_SESSION['valid'])){
    header("Location:/GescaCFS/Pages/PHP/Other/Login/login.php");
    exit();
}else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedName = $_POST['selectedName'];
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $databaseName = "gescatest";

        $userID = NULL;

        $conn = new mysqli($hostName, $userName, $password, $databaseName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT users.ID FROM users INNER JOIN names ON users.ID = names.`User ID` WHERE users.User_Name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $userID = $row['ID'];
        }

        $query = "SELECT Content, Time_Created FROM fills WHERE User_ID = ? AND Name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $userID, $selectedName);
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
}



