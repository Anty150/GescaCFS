<?php
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: /GescaCFS/Scripts/PHP/Other/Login/loginScript.php");
    exit();
}
else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedItem = $_POST['selectedItem'];

        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $databaseName = "gescatest";
        $conn = new mysqli($hostName, $userName, $password, $databaseName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $userName = $_SESSION['username'];
        $userID = NULL;

        $sql = "SELECT ID FROM users WHERE `User_Name` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $userID = $row['ID'];
        }

        $queryFieldNameTB = "SELECT `field name` FROM `field names` JOIN names ON `field names`.`Name ID` = names.ID WHERE names.Name = ? AND `field names`.`User ID` = ?";
        $stmt = $conn->prepare($queryFieldNameTB);
        $stmt->bind_param("si", $selectedItem, $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $fieldNames = array();
            while ($row = $result->fetch_assoc()) {
                $fieldNames[] = $row['field name'];
            }
            $response1 = implode('|', $fieldNames);
        } else {
            $response1 = "No field names found.";
        }

        $queryTypesTB = "SELECT `type` FROM `field names` JOIN names ON `field names`.`Name ID` = names.ID WHERE names.Name = ? AND `field names`.`User ID` = ?";
        $stmt = $conn->prepare($queryTypesTB);
        $stmt->bind_param("si", $selectedItem, $userID);
        $stmt->execute();
        $resultAllNames = $stmt->get_result();

        if ($resultAllNames->num_rows > 0) {
            $names = array();
            while ($row = $resultAllNames->fetch_assoc()) {
                $names[] = $row['type'];
            }
            $response2 = implode('|', $names);
        } else {
            $response2 = "No names found.";
        }

        $conn->close();

        echo $response1 . "#" . $response2;
    }
}
